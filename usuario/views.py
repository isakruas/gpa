import os
from django.conf import settings
from django.views.generic import TemplateView, CreateView
from .models import Usuario
from .forms import UsuarioCreationForm
from curso.models import Curso
from prova.models import Prova
from prova_gerada.models import ProvaGerada
from django.http import QueryDict
from django.http import HttpResponse, HttpResponseRedirect
from django.utils.safestring import mark_safe
import json
from django.urls import reverse
from questao.models import Questao
from django.utils.text import slugify
from random import sample


class UsuarioCreateView(CreateView):
    template_name = os.path.join(settings.BASE_DIR, 'usuario/templates/criar_conta.html')
    form_class = UsuarioCreationForm
    success_url = '/'

class PainelDeControleVisualizarProvaTemplateView(TemplateView):
	
	template_name = os.path.join(settings.BASE_DIR, 'usuario/templates/painel_de_controle_visualizar_prova.html')

	def get(self, request, *args, **kwargs):

		context = self.get_context_data(**kwargs)

		try:
			prova = ProvaGerada.objects.get(id=int(mark_safe(kwargs['prova'])), usuario=request.user) 
		except Exception as e:
			return HttpResponseRedirect(reverse('painel_de_controle_template_view'))
		
		questoes = {}

		questao = prova.questao.split('.')
		
		for x in range(0,len(questao)):
			try:
				q = Questao.objects.get(id=int(questao[x]))
				questoes[x+1] = [q.pergunta,q.imagem]
			except Exception as e:
				pass

		context['questao'] = questoes
		context['nome'] = prova.nome
		context['curso'] = prova.curso

		return self.render_to_response(context)

class PainelDeControleTemplateView(TemplateView):
	
	template_name = os.path.join(settings.BASE_DIR, 'usuario/templates/painel_de_controle.html')

	def get(self, request, *args, **kwargs):

		curso = Curso.objects.get(id=int(request.user.curso))

		prova = Prova.objects.filter(curso=str(curso.id), status=str(2))

		search = []
		
		"""
			Se a prova estiver disponivel e ainda não estiver sido gerada pelo usuário
		"""
		for x in range(0,len(prova)):
			if len(ProvaGerada.objects.filter(nome=str(prova[x].nome), curso=str(curso.nome), usuario=request.user.id)) == 0:
				el  = {
					'id': prova[x].id,
					'nome': prova[x].nome,
					'curso': curso.nome,
				}
				search.append(el)

		context = self.get_context_data(**kwargs)

		"""
			Envia para o tamplete o resultado da busca
		"""
		context['prova_disponivel'] = search


		prova_gerada = ProvaGerada.objects.filter(usuario=request.user)

		search2 = []
		
		for x in range(0,len(prova_gerada)):
			el  = {
				'id': prova_gerada[x].id,
				'nome': prova_gerada[x].nome,
				'curso': prova_gerada[x].curso,
			}
			search2.append(el)


		context['prova_gerada'] = search2

		return self.render_to_response(context)



def PainelDeControleGerarProva(request, *args, **kwargs):
	
	curso = Curso.objects.get(id=int(request.user.curso))

	try:
		prova = Prova.objects.get(id=int(mark_safe(kwargs['prova']))) 
	except Exception as e:
		return HttpResponseRedirect(reverse('painel_de_controle_template_view'))
	
	if not str(prova.status) == str(2):
		return HttpResponseRedirect(reverse('painel_de_controle_template_view'))

	if len(ProvaGerada.objects.filter(nome=str(prova.nome), curso=str(curso.nome), usuario=request.user.id)) == 0:
	
		questao = Questao.objects.filter(curso=slugify(curso.nome), prova=slugify(prova.nome))

		"""
			Procura todas as questões correspondentes ao filtro
			Escolhe, de forma aleatria, uma questão candidata
			para cada numéro, e os coloca em ordem crescente.
		"""
		n = {}
		q = []
		u = ''

		for x in range(0,len(questao)):
			if questao[x].numero not in n:
				n[questao[x].numero] = []
				q.append(questao[x].numero)

		for x in range(0,len(questao)):
			n[questao[x].numero].append(questao[x].id)

		for x in range(0,len(q)):
			i = sample(range(0, len(n[q[x]])), 1)
			j = n[q[x]][i[0]]
			if (x+1) == len(q):
				u+=str(j)
			else:
				u+=str(j)+'.'

		"""
			Salva a prova gerada no banco de dados
		"""
		p = ProvaGerada(
			nome=str(prova.nome),
			curso=str(curso.nome),
			usuario=request.user,
			questao=str(u)
			)
		p.save()

		return HttpResponseRedirect(reverse('painel_de_controle_template_view'))
	else:
		return HttpResponseRedirect(reverse('painel_de_controle_template_view'))


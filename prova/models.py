from django.db import models
from django.utils.text import slugify

CURSOS = []

try:
    from curso.models import Curso
    CURSOS = [(str(i), Curso.objects.get(id=i).nome) for i in range(1,len(Curso.objects.all())+1)] 
except Exception as e:
    pass

class Prova(models.Model):
    
    nome = models.CharField(
    	'Nome',
    	max_length=300,
        null=False,
        blank=False,
    )
    
    STATUS = (
        ('1', 'Não disponivel para os alunos'),
        ('2', 'Disponivel para os alunos'),
        ('3', 'Em correção')
    )

    curso = models.CharField(
        'Curso',
    	max_length=300,
        null=False,
        blank=False,
        choices=CURSOS
    )

    status = models.CharField(
        'Status',
        null=False,
        blank=False,
        max_length=300,
        choices=STATUS
    )

    class Meta:
        ordering = ['id']
        verbose_name = 'Prova'
        verbose_name_plural = 'Provas'

    def __str__(self):
        return str(self.id)

    def slug(self):
            return slugify(self.nome)
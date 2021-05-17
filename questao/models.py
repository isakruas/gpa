from django.db import models
from django.utils.text import slugify

CURSOS = []
PROVAS = []


try:
    from curso.models import Curso
    CURSOS = [(str(Curso.objects.get(id=i).slug()), Curso.objects.get(id=i).nome) for i in range(1,len(Curso.objects.all())+1)] 
except Exception as e:
    pass

try:
    from prova.models import Prova
    PROVAS = [(str(Prova.objects.get(id=i).slug()), Prova.objects.get(id=i).nome) for i in range(1,len(Prova.objects.all())+1)] 
except Exception as e:
    pass


class Questao(models.Model):

    curso = models.CharField(
        null=False,
        blank=False,
        max_length=300,
        choices=CURSOS
    )

    prova = models.CharField(
        max_length=300,
        null=False,
        blank=False,
        choices=PROVAS
    )

    numero = models.IntegerField()

    imagem = models.ImageField(
        upload_to='uploads/',
        null=True,
        blank=True,
    )

    pergunta = models.TextField()

    class Meta:
        ordering = ['id']
        verbose_name = 'Questão'
        verbose_name_plural = 'Questões'
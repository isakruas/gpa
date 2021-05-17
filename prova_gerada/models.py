from django.db import models
from usuario.models import Usuario

class ProvaGerada(models.Model):

    curso = models.CharField(
        'Curso',
        max_length=300,
        null=False,
        blank=False,
    )

    nome = models.CharField(
        'Nome',
        max_length=300,
        null=False,
        blank=False,
    )

    usuario = models.ForeignKey(Usuario, related_name='prova_gerada', on_delete=models.CASCADE)
    
    questao = models.TextField()

    class Meta:
        ordering = ['id']
        verbose_name = 'Prova Gerada'
        verbose_name_plural = 'Provas Geradas'

    def __str__(self):
        return str(self.id)

from django.db import models
from django.utils.text import slugify


class Curso(models.Model):

    nome = models.CharField(
        'Nome',
        max_length=300,
        null=False,
        blank=False,
    )

    class Meta:
        ordering = ['id']
        verbose_name = 'Curso'
        verbose_name_plural = 'Cursos'

    def __str__(self):
        return str(self.id)

    def slug(self):
            return slugify(self.nome)
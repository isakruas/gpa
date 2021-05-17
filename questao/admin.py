from django.contrib import admin
from .models import (
    Questao
)

@admin.register(Questao)
class QuestaoAdmin(admin.ModelAdmin):
    list_display = (
    	'numero',
    	'curso',
    	'prova',
    	'imagem',
        'pergunta',
    )

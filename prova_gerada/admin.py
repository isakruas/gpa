from django.contrib import admin
from .models import (
    ProvaGerada
)

@admin.register(ProvaGerada)
class ProvaGeradaAdmin(admin.ModelAdmin):
    list_display = (
    	'usuario',
    	'curso',
    	'nome',
        'questao',
    )

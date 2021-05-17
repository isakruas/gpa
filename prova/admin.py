from django.contrib import admin
from .models import (
    Prova
)

@admin.register(Prova)
class ProvaAdmin(admin.ModelAdmin):
    list_display = (
        'nome',
        'curso',
        'status'
    )

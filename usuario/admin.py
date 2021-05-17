from django.contrib import admin
from django.contrib.auth.models import Group
from .models import (
    Usuario
)
from .forms import (
	UsuarioCreationForm,
	UsuarioChangeForm
)


@admin.register(Usuario)
class UsuarioAdmin(admin.ModelAdmin):
    add_form = UsuarioCreationForm
    form = UsuarioChangeForm
    list_display = (
        'id',
        'nome',
        'email',
        'curso',
    )

admin.site.unregister(Group)
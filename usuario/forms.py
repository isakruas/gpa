from django.contrib.auth.forms import UserCreationForm, UserChangeForm
from django import forms
from .models import Usuario
from django.contrib.auth.forms import ReadOnlyPasswordHashField
from django.core.exceptions import ValidationError


class UsuarioCreationForm(UserCreationForm):

    password1 = forms.CharField(label='Senha', widget=forms.PasswordInput(attrs={'class': 'form-control'}))
    password2 = forms.CharField(label='Confirmação de senha', widget=forms.PasswordInput(attrs={'class': 'form-control'}))

    class Meta:
        model = Usuario
        fields = ('nome', 'curso', 'email')

        widgets = {
            'nome': forms.TextInput(attrs={'class': 'form-control'}),
            'curso': forms.Select(attrs={'class': 'form-control'}),
            'email': forms.EmailInput(attrs={'class': 'form-control'}),
        }


    def clean_password2(self):
        password1 = self.cleaned_data.get('password1')
        password2 = self.cleaned_data.get('password2')
        if password1 and password2 and password1 != password2:
            raise ValidationError('Os dois campos de senha não correspondem.')
        return password2

    def save(self, commit=True):
        user = super().save(commit=False)
        user.set_password(self.cleaned_data['password1'])
        if commit:
            user.save()
        return user



class UsuarioChangeForm(UserChangeForm):

    password = ReadOnlyPasswordHashField()

    def clean_password(self):
        return self.initial['password']

    class Meta:
        model = Usuario
        fields = ('nome', 'curso', 'password')


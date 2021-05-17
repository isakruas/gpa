from django.urls import path
from django.contrib.auth import views as auth_views
from .views import (
    UsuarioCreateView,
    PainelDeControleTemplateView,
    PainelDeControleGerarProva,
    PainelDeControleVisualizarProvaTemplateView
)

urlpatterns = [

    path('painel_de_controle/sair/', auth_views.LogoutView.as_view(next_page='/'), name='usuario_logout_view'),
    
    path('painel_de_controle/', PainelDeControleTemplateView.as_view(), name='painel_de_controle_template_view'),

    path('painel_de_controle/visualizar_prova/<str:prova>/', PainelDeControleVisualizarProvaTemplateView.as_view(), name='painel_de_controle_visualizar_prova_template_view'),
    
    path('painel_de_controle/gerar_prova/<str:prova>/', PainelDeControleGerarProva, name='painel_de_controle_gerar_prova_template_view'),
    
    path('criar_conta/', UsuarioCreateView.as_view(), name='usuario_create_view'),
    
    path('', auth_views.LoginView.as_view(
        template_name='usuario/templates/entrar.html',
        success_url='/',
    ), name='usuario_auth_view', ),
    path('redefinicao_de_senha/',
		auth_views.PasswordResetView.as_view(
			template_name='redefinicao_de_senha.html',
			email_template_name='redefinicao_de_senha_email.html',
			success_url='../',
			from_email='no-reply@bq.mat.br'
		), name='usuario_password_reset_view'
    ),

    path('redefinicao_de_senha/<slug:uidb64>/<slug:token>/',
         auth_views.PasswordResetConfirmView.as_view(
             template_name='redefinicao_de_senha_confirmacao.html',
             success_url='../../../'
         ), name='usuario_password_reset_confirm_view'
         ),
]


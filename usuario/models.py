from django.contrib.auth.models import (
    BaseUserManager, AbstractBaseUser, PermissionsMixin
)
from django.db import models


class Base(BaseUserManager):

    use_in_migrations = True

    def _create_user(self, email, password, **extra_fields):
        if not email:
            raise ValueError('O e-mail é obrigatório')
        email = self.normalize_email(email)
        user = self.model(email=email, **extra_fields)
        user.set_password(password)
        user.save(using=self._db)
        return user

    def create_user(self, email, password=None, **extra_fields):
        # extra_fields.setdefault('is_active', True)
        extra_fields.setdefault('is_superuser', False)
        return self._create_user(email, password, **extra_fields)

    def create_superuser(self, email, password, **extra_fields):

        extra_fields.setdefault('is_superuser', True)
        extra_fields.setdefault('is_active', True)
        extra_fields.setdefault('curso', None)

        if extra_fields.get('is_superuser') is not True:
            raise ValueError('Superuser precisa ter is_superuser=True')

        if extra_fields.get('is_active') is not True:
            raise ValueError('Superuser precisa ter is_active=True')

        return self._create_user(email, password, **extra_fields)

    class Meta:
        abstract = True


CURSOS = []

try:
    from curso.models import Curso
    CURSOS = [(str(i), Curso.objects.get(id=i).nome) for i in range(1,len(Curso.objects.all())+1)] 
except Exception as e:
    pass


class Usuario(AbstractBaseUser, PermissionsMixin):
    objects = Base()


    curso = models.CharField(
        'Curso',
        max_length=300,
        null=True,
        blank=True,
        choices=CURSOS
    )

    nome = models.CharField(
        'Nome completo',
        max_length=30,
        blank=None
    )


    email = models.EmailField(
        'Email',
        max_length=255,
        unique=True,

    )

    is_active = models.BooleanField(default=True)

    USERNAME_FIELD = ('email')
    REQUIRED_FIELDS = ['nome', 'curso']

    class Meta:
        verbose_name = 'Usuário'
        verbose_name_plural = 'Usuários'
        ordering = ['id']

    def __str__(self):
        return self.email

    def has_perm(self, perm, obj=None):
        return True

    def has_module_perms(self, app_label):
        return True

    @property
    def is_staff(self):
        return self.is_superuser

    @property
    def is_admin(self):
        return self.is_superuser



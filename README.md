# Places API

API RESTful para gerenciar lugares (places), desenvolvida com Laravel 12, PostgreSQL e Docker (Laravel Sail).

## Requisitos

- Docker e Docker Compose

## 🐳 Instruções para rodar com Docker (Laravel Sail)

1. **Instalar dependências**
   ```bash
   composer install
   ```

2. **Copiar o arquivo de ambiente**
   ```bash
   cp .env.example .env
   ```

3. **Iniciar o ambiente com Sail**
   ```bash
   ./vendor/bin/sail up -d
   ```

4. **Rodar migrations**
   ```bash
   ./vendor/bin/sail artisan migrate
   ```

5. **Rodar testes**
   ```bash
   ./vendor/bin/sail artisan test
   ```

---

## Endpoints

### Listar todos os lugares
```http
GET /api/places
```

### Buscar por nome
```http
GET /api/places?name=termo
```

### Buscar com endpoint separado
```http
GET /api/places/search?name=termo
```

### Criar novo lugar
```http
POST /api/places
{
  "name": "Parque Central",
  "slug": "ibirapuera",
  "city": "São Paulo",
  "state": "SP"
}
```

### Ver um lugar específico
```http
GET /api/places/{id}
```

### Atualizar um lugar
```http
PUT /api/places/{id}
{
  "name": "Parque Atualizado",
  "slug": "ibirapuera Atualizado",
  "city": "São Paulo",
  "state": "SP"
}
```

### Remover um lugar
```http
DELETE /api/places/{id}
```

---

## Testes

Para rodar os testes automatizados:
```bash
./vendor/bin/sail artisan test
```

Os testes estão localizados em `tests/Feature/PlacesTest.php` e cobrem:

- Criação
- Listagem
- Filtro por nome
- Visualização individual
- Edição
- Remoção

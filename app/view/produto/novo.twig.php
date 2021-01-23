{% extends "partials/body.twig.php" %}

{% block title %} Novo roduto | Mini-framework{% endblock %}

{% block body %}
<div class="max-width center-screen bg-white padding">

    <h1 class="m-0">Novo produto</h1>

    <hr>

    <form action="{{BASE}}insert_produto/" method="POST">

        <div class="form-group">
            <label for="nome-produto">Nome do produto</label>
            <input class="form-control border border-secondary" id="nome-produto" name="nome-produto" placeholder="Placa de vídeo" required>
        </div>

        <div class="form-group">
            <label for="url-img">Imagem do produto</label>
            <input class="form-control border border-secondary" id="url-img" name="url-img" placeholder="URL da imagem ">
        </div>

        <div class="form-group">
            <label for="desc-prod">Descrição do produto</label>
            <textarea style="resize: none" rows="5" class="form-control border border-secondary" id="desc-prod" name="desc-prod" placeholder="Descrição do produto" required></textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-success" type="submit">Salvar</button>
        </div>

    </form>

</div>
{% endblock %}

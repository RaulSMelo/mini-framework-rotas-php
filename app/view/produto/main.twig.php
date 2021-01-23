{% extends "partials/body.twig.php" %}

{% block title %} Produto | Mini-framework{% endblock %}

{%block body %}
<div class="max-width center-screen bg-white padding">
    <h1 class="m-0">Produto</h1>
    <p class="mt-3">Página de produtos</p>

    <hr>


    <a href="{{BASE}}novo_produto/" class="btn btn-info btn-sm">Novo produto</a>

</div>
{% endblock %}

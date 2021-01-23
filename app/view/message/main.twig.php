{% extends "partials/body.twig.php" %}

{% block title %} Página não encontrada{% endblock %}

{%block body %}
<div class="max-width center-screen bg-white padding">
    <div class="card border-danger mb-3">
        <div class="card-header"><h5>{{title}}</h5></div>
        <div class="card-body">
            <p class="card-text">{{message}}</p>
        </div>
    </div>
</div>
{% endblock %}








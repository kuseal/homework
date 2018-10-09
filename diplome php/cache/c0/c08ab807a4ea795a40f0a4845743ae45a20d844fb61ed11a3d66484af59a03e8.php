<?php

/* navbar.html */
class __TwigTemplate_f12a613e071d402bb44f0839b75b2775c902654611017ca97c0bee4bebca7a49 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<nav class=\"navbar navbar-inverse\">
  <div class=\"container\">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class=\"navbar-header\">
      <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\" aria-expanded=\"false\">
        <span class=\"sr-only\">Toggle navigation</span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
      </button>
      <a class=\"navbar-brand\" href=\"/admin\">Админпанель</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
      <ul class=\"nav navbar-nav\">
        <li class=\"dropdown\">
          <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Темы <span class=\"caret\"></span></a>
          <ul class=\"dropdown-menu\">
\t\t\t<li><a href=\"/themes/\" class=\"list-group-item\">Все темы <span class=\"badge\">";
        // line 20
        echo twig_escape_filter($this->env, twig_length_filter($this->env, (isset($context["themes"]) ? $context["themes"] : null)), "html", null, true);
        echo "</span></a></li>
\t\t\t<li><a href=\"/themes/create\" class=\"list-group-item\"> Создать тему</a></li>
\t\t\t<li role=\"separator\" class=\"divider\"></li>
            ";
        // line 23
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["themes"]) ? $context["themes"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["theme"]) {
            // line 24
            echo "            <li><a href=\"/themes/theme/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["theme"], "id_cat", array()), "html", null, true);
            echo "\" class=\"list-group-item\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["theme"], "title", array()), "html", null, true);
            echo "<span class=\"badge\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["theme"], "count_quests", array()), "html", null, true);
            echo "</span></a></li>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['theme'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        echo "          </ul>
        </li>
        <li class=\"dropdown\">
          <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Вопросы <span class=\"caret\"></span></a>
          <ul class=\"dropdown-menu\">
            <li><a href=\"/questions\">Все вопросы</a></li>
            <li><a href=\"/questions/empty_questions\">Без ответа</a></li>
          </ul>
        </li>
<li><a href=\"/admin/all_admins\">Администраторы</a></li>
      </ul>
      <ul class=\"nav navbar-nav navbar-right\">
      <li style=\"padding-top: 15px;color: #ffffff\">";
        // line 38
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["session"]) ? $context["session"] : null), "loginAdmin", array()), "html", null, true);
        echo "</li>
        <li><a href=\"/login/logout\">Выход</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>";
    }

    public function getTemplateName()
    {
        return "navbar.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 38,  63 => 26,  50 => 24,  46 => 23,  40 => 20,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "navbar.html", "/home/c/cf32186/public_html/views/backend/navbar.html");
    }
}

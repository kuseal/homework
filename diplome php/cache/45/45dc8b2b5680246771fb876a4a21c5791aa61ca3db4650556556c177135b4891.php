<?php

/* tmpl_admin.html */
class __TwigTemplate_a6828d8cdd69e94f740599163a3081acdc2bf059585b4819ce0f3b9466dc91a4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
  <head>
\t<meta charset=\"utf-8\">
\t<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
\t<title>";
        // line 7
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "</title>

\t<link rel=\"stylesheet\" href=\"../../assets/bootstrap/css/bootstrap.css\">
\t<link rel=\"stylesheet\" href=\"../../assets/css/style.css\">

  </head>
  <body>

\t<header class=\"header\">
\t  ";
        // line 16
        $this->loadTemplate("navbar.html", "tmpl_admin.html", 16)->display($context);
        // line 17
        echo "\t</header>

\t<section class=\"container\">
\t  <div class=\"row\">
\t\t<div class=\"col-md-12\">
\t\t  <div class=\"page-header\">
\t\t\t<h1>Админ | ";
        // line 23
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "</h1>
\t\t  </div>
\t\t</div>
\t  </div>
\t  <div class=\"row\">
\t\t<div class=\"col-md-3\">
\t\t<h3>Темы</h3>
\t\t  <div class=\"panel-group br-r\" id=\"accordion\" role=\"tablist\" aria-multiselectable=\"true\">
\t\t\t<div class=\"list-group\">
\t\t\t  ";
        // line 32
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["themes"]) ? $context["themes"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["theme"]) {
            // line 33
            echo "\t\t\t  <a href=\"/themes/theme/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["theme"], "id_cat", array()), "html", null, true);
            echo "\" class=\"list-group-item\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["theme"], "title", array()), "html", null, true);
            echo " <span class=\"badge\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["theme"], "count_quests", array()), "html", null, true);
            echo "</span></a>
\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['theme'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 35
        echo "\t\t\t</div>
\t\t  </div>
\t\t</div>
\t\t<div class=\"col-md-9 mb-50\">
\t\t";
        // line 39
        if ((isset($context["error"]) ? $context["error"] : null)) {
            // line 40
            echo "        <div class=\"alert alert-danger text-center\">
        ";
            // line 41
            echo twig_escape_filter($this->env, (isset($context["error"]) ? $context["error"] : null), "html", null, true);
            echo "
        </div>
        ";
        }
        // line 44
        echo "\t\t  ";
        $this->displayBlock('content', $context, $blocks);
        // line 46
        echo "\t\t</div>
\t  </div>
\t</section>

\t<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js\"></script>
\t<script src=\"../../assets/bootstrap/js/bootstrap.js\"></script>
\t<script src=\"../../assets/js/scripts.js\"></script>
  </body>
</html>";
    }

    // line 44
    public function block_content($context, array $blocks = array())
    {
        // line 45
        echo "\t\t  ";
    }

    public function getTemplateName()
    {
        return "tmpl_admin.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  114 => 45,  111 => 44,  99 => 46,  96 => 44,  90 => 41,  87 => 40,  85 => 39,  79 => 35,  66 => 33,  62 => 32,  50 => 23,  42 => 17,  40 => 16,  28 => 7,  20 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "tmpl_admin.html", "/home/c/cf32186/public_html/views/backend/tmpl_admin.html");
    }
}

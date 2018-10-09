<?php

/* /login/login_page.html */
class __TwigTemplate_cae19200fe14c45e522b95591f3a32947cfb823fe83f573d8e56e0bc626f70b4 extends Twig_Template
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
        echo "<!DOCTYPE html>
<html lang=\"ru\">
<head>
  <meta charset=\"UTF-8\">
  <title>";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "</title>
  <link rel=\"stylesheet\" href=\"../../../assets/bootstrap/css/bootstrap.css\">
  <link rel=\"stylesheet\" href=\"../../../assets/css/style.css\">
</head>
<body>
    <div class=\"container mt-50\">
        <div class=\"row\">
            <div class=\"col-md-offset-4 col-md-4\">
            <h2>Вход</h2>
            ";
        // line 14
        if (((isset($context["error"]) ? $context["error"] : null) != null)) {
            // line 15
            echo "            <div class=\"alert alert-danger\">
            ";
            // line 16
            echo twig_escape_filter($this->env, (isset($context["error"]) ? $context["error"] : null), "html", null, true);
            echo "
            </div>
            ";
        }
        // line 19
        echo "                <form method=\"post\"  action=\"/login\">
                  <div class=\"form-group\">
                    <label for=\"login\">Логин</label>
                    <input type=\"text\" class=\"form-control\" name=\"login\" id=\"login\" placeholder=\"Логин\" required>
                  </div>
                  <div class=\"form-group\">
                    <label for=\"pass\">Пароль</label>
                    <input type=\"password\" class=\"form-control\" name=\"pass\" id=\"pass\" placeholder=\"Пароль\" required>
                  </div>
                  <button type=\"submit\" class=\"btn btn-primary\">Вход</button>
                </form>
            </div>
        </div>
    </div>
\t<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js\"></script>
\t<script src=\"../../../assets/bootstrap/js/bootstrap.js\"></script>
\t<script src=\"../../../assets/js/scripts.js\"></script>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "/login/login_page.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 19,  42 => 16,  39 => 15,  37 => 14,  25 => 5,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "/login/login_page.html", "/home/c/cf32186/public_html/views/backend/login/login_page.html");
    }
}

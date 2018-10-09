<?php

/* /admin/admin_page.html */
class __TwigTemplate_27d64075569e9ebab4505c9a6f4b5e164e7d044ad9ce9a1e5e3f1363cd04292d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("tmpl_admin.html", "/admin/admin_page.html", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "tmpl_admin.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_content($context, array $blocks = array())
    {
        // line 3
        echo "<div class=\"\">
<div class=\"jumbotron text-center\">
  <h2>Добро пожаловать в панель администратора!</h2>
</div>
<div class=\"row\">
<div class=\"col-md-4\">
 <a class=\"admins\" href=\"/admin/all_admins\">Админов ";
        // line 9
        echo twig_escape_filter($this->env, twig_length_filter($this->env, (isset($context["admins"]) ? $context["admins"] : null)), "html", null, true);
        echo "</a>
</div>
<div class=\"col-md-4\">
<a class=\"themes\" href=\"/themes/\">Тем ";
        // line 12
        echo twig_escape_filter($this->env, twig_length_filter($this->env, (isset($context["themes"]) ? $context["themes"] : null)), "html", null, true);
        echo "</a>
</div>
<div class=\"col-md-4\">
<a class=\"questions\" href=\"/questions\">Вопросов ";
        // line 15
        echo twig_escape_filter($this->env, twig_length_filter($this->env, (isset($context["questions"]) ? $context["questions"] : null)), "html", null, true);
        echo "</a>
</div>
</div>
</div>

";
    }

    public function getTemplateName()
    {
        return "/admin/admin_page.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 15,  45 => 12,  39 => 9,  31 => 3,  28 => 2,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "/admin/admin_page.html", "/home/c/cf32186/public_html/views/backend/admin/admin_page.html");
    }
}

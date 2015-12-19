<?php

/* base.html.twig */
class __TwigTemplate_3f6d349ce8c1ec843154e651c4f88f756f2e962328e41ef6c967ed0e7d5238d1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_5c56a3ef2ed068a1558f67d52e0dad0adfc811111fc422f9c54d66a20c33d551 = $this->env->getExtension("native_profiler");
        $__internal_5c56a3ef2ed068a1558f67d52e0dad0adfc811111fc422f9c54d66a20c33d551->enter($__internal_5c56a3ef2ed068a1558f67d52e0dad0adfc811111fc422f9c54d66a20c33d551_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 7
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        ";
        // line 10
        $this->displayBlock('body', $context, $blocks);
        // line 11
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 12
        echo "    </body>
</html>
";
        
        $__internal_5c56a3ef2ed068a1558f67d52e0dad0adfc811111fc422f9c54d66a20c33d551->leave($__internal_5c56a3ef2ed068a1558f67d52e0dad0adfc811111fc422f9c54d66a20c33d551_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_8a6e20343e6a8821d6cad6d4c0a0efd2c3457fde6c4727c2d0ca956462f2db29 = $this->env->getExtension("native_profiler");
        $__internal_8a6e20343e6a8821d6cad6d4c0a0efd2c3457fde6c4727c2d0ca956462f2db29->enter($__internal_8a6e20343e6a8821d6cad6d4c0a0efd2c3457fde6c4727c2d0ca956462f2db29_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Welcome!";
        
        $__internal_8a6e20343e6a8821d6cad6d4c0a0efd2c3457fde6c4727c2d0ca956462f2db29->leave($__internal_8a6e20343e6a8821d6cad6d4c0a0efd2c3457fde6c4727c2d0ca956462f2db29_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_a4f265a42f8ec29eef59b692cc353b9e2a2d5e67f19639d244dec1ea92057f16 = $this->env->getExtension("native_profiler");
        $__internal_a4f265a42f8ec29eef59b692cc353b9e2a2d5e67f19639d244dec1ea92057f16->enter($__internal_a4f265a42f8ec29eef59b692cc353b9e2a2d5e67f19639d244dec1ea92057f16_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_a4f265a42f8ec29eef59b692cc353b9e2a2d5e67f19639d244dec1ea92057f16->leave($__internal_a4f265a42f8ec29eef59b692cc353b9e2a2d5e67f19639d244dec1ea92057f16_prof);

    }

    // line 10
    public function block_body($context, array $blocks = array())
    {
        $__internal_2c9929ad797fd88f1f692024092f76eb575158386c97fbb45e66cc266b28ef38 = $this->env->getExtension("native_profiler");
        $__internal_2c9929ad797fd88f1f692024092f76eb575158386c97fbb45e66cc266b28ef38->enter($__internal_2c9929ad797fd88f1f692024092f76eb575158386c97fbb45e66cc266b28ef38_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_2c9929ad797fd88f1f692024092f76eb575158386c97fbb45e66cc266b28ef38->leave($__internal_2c9929ad797fd88f1f692024092f76eb575158386c97fbb45e66cc266b28ef38_prof);

    }

    // line 11
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_6cb5781cc8b71ab5fe88ac09fe8e43c9e59d3980d2346ddbb2d51b820027c0d8 = $this->env->getExtension("native_profiler");
        $__internal_6cb5781cc8b71ab5fe88ac09fe8e43c9e59d3980d2346ddbb2d51b820027c0d8->enter($__internal_6cb5781cc8b71ab5fe88ac09fe8e43c9e59d3980d2346ddbb2d51b820027c0d8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_6cb5781cc8b71ab5fe88ac09fe8e43c9e59d3980d2346ddbb2d51b820027c0d8->leave($__internal_6cb5781cc8b71ab5fe88ac09fe8e43c9e59d3980d2346ddbb2d51b820027c0d8_prof);

    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 11,  82 => 10,  71 => 6,  59 => 5,  50 => 12,  47 => 11,  45 => 10,  38 => 7,  36 => 6,  32 => 5,  26 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/*     <head>*/
/*         <meta charset="UTF-8" />*/
/*         <title>{% block title %}Welcome!{% endblock %}</title>*/
/*         {% block stylesheets %}{% endblock %}*/
/*         <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />*/
/*     </head>*/
/*     <body>*/
/*         {% block body %}{% endblock %}*/
/*         {% block javascripts %}{% endblock %}*/
/*     </body>*/
/* </html>*/
/* */

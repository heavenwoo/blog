<?php

/* @Twig/Exception/exception_full.html.twig */
class __TwigTemplate_870dc73c2a700c3147405aa4fc9050d826bd3f93d39c480c85d917cd539844f0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@Twig/layout.html.twig", "@Twig/Exception/exception_full.html.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@Twig/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_c797d0f1628fba37c35d8e05ac27752d5f974c7c2e3b91c4d1a8435f7483f8fe = $this->env->getExtension("native_profiler");
        $__internal_c797d0f1628fba37c35d8e05ac27752d5f974c7c2e3b91c4d1a8435f7483f8fe->enter($__internal_c797d0f1628fba37c35d8e05ac27752d5f974c7c2e3b91c4d1a8435f7483f8fe_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_c797d0f1628fba37c35d8e05ac27752d5f974c7c2e3b91c4d1a8435f7483f8fe->leave($__internal_c797d0f1628fba37c35d8e05ac27752d5f974c7c2e3b91c4d1a8435f7483f8fe_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_962f0bd3ccf3580b579927cc4c05b61c926c4c00e142c9bbc6bc3c570bd262ac = $this->env->getExtension("native_profiler");
        $__internal_962f0bd3ccf3580b579927cc4c05b61c926c4c00e142c9bbc6bc3c570bd262ac->enter($__internal_962f0bd3ccf3580b579927cc4c05b61c926c4c00e142c9bbc6bc3c570bd262ac_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_962f0bd3ccf3580b579927cc4c05b61c926c4c00e142c9bbc6bc3c570bd262ac->leave($__internal_962f0bd3ccf3580b579927cc4c05b61c926c4c00e142c9bbc6bc3c570bd262ac_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_60416c6278b93c330e8e98b1ccb8ebe5d4652769f3105507c054f98eae895ccc = $this->env->getExtension("native_profiler");
        $__internal_60416c6278b93c330e8e98b1ccb8ebe5d4652769f3105507c054f98eae895ccc->enter($__internal_60416c6278b93c330e8e98b1ccb8ebe5d4652769f3105507c054f98eae895ccc_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_60416c6278b93c330e8e98b1ccb8ebe5d4652769f3105507c054f98eae895ccc->leave($__internal_60416c6278b93c330e8e98b1ccb8ebe5d4652769f3105507c054f98eae895ccc_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_dda38f70e1dd22fd57b8a6d0102d10b9b38ac1f2069374f078284a9530a20466 = $this->env->getExtension("native_profiler");
        $__internal_dda38f70e1dd22fd57b8a6d0102d10b9b38ac1f2069374f078284a9530a20466->enter($__internal_dda38f70e1dd22fd57b8a6d0102d10b9b38ac1f2069374f078284a9530a20466_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "@Twig/Exception/exception_full.html.twig", 12)->display($context);
        
        $__internal_dda38f70e1dd22fd57b8a6d0102d10b9b38ac1f2069374f078284a9530a20466->leave($__internal_dda38f70e1dd22fd57b8a6d0102d10b9b38ac1f2069374f078284a9530a20466_prof);

    }

    public function getTemplateName()
    {
        return "@Twig/Exception/exception_full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 12,  72 => 11,  58 => 8,  52 => 7,  42 => 4,  36 => 3,  11 => 1,);
    }
}
/* {% extends '@Twig/layout.html.twig' %}*/
/* */
/* {% block head %}*/
/*     <link href="{{ absolute_url(asset('bundles/framework/css/exception.css')) }}" rel="stylesheet" type="text/css" media="all" />*/
/* {% endblock %}*/
/* */
/* {% block title %}*/
/*     {{ exception.message }} ({{ status_code }} {{ status_text }})*/
/* {% endblock %}*/
/* */
/* {% block body %}*/
/*     {% include '@Twig/Exception/exception.html.twig' %}*/
/* {% endblock %}*/
/* */

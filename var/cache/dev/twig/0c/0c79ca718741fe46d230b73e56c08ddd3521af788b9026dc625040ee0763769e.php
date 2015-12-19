<?php

/* @WebProfiler/Collector/router.html.twig */
class __TwigTemplate_29946509db454b4d864643e2c8682e6a0907c5c170f3922deeb5e3482b1987c0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/router.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_31fa4ba0bb6a2d12d58361af673c814b2a17e8894590cba3fd55ddc8810e4130 = $this->env->getExtension("native_profiler");
        $__internal_31fa4ba0bb6a2d12d58361af673c814b2a17e8894590cba3fd55ddc8810e4130->enter($__internal_31fa4ba0bb6a2d12d58361af673c814b2a17e8894590cba3fd55ddc8810e4130_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_31fa4ba0bb6a2d12d58361af673c814b2a17e8894590cba3fd55ddc8810e4130->leave($__internal_31fa4ba0bb6a2d12d58361af673c814b2a17e8894590cba3fd55ddc8810e4130_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_76d7f382009b0a6f4c4517eddf435fd25d46c81ddd021743d1418941dab9402f = $this->env->getExtension("native_profiler");
        $__internal_76d7f382009b0a6f4c4517eddf435fd25d46c81ddd021743d1418941dab9402f->enter($__internal_76d7f382009b0a6f4c4517eddf435fd25d46c81ddd021743d1418941dab9402f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_76d7f382009b0a6f4c4517eddf435fd25d46c81ddd021743d1418941dab9402f->leave($__internal_76d7f382009b0a6f4c4517eddf435fd25d46c81ddd021743d1418941dab9402f_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_68490acfd094933b7cbf2e016bb3678124765beb07b553e5a36411c0182b4854 = $this->env->getExtension("native_profiler");
        $__internal_68490acfd094933b7cbf2e016bb3678124765beb07b553e5a36411c0182b4854->enter($__internal_68490acfd094933b7cbf2e016bb3678124765beb07b553e5a36411c0182b4854_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_68490acfd094933b7cbf2e016bb3678124765beb07b553e5a36411c0182b4854->leave($__internal_68490acfd094933b7cbf2e016bb3678124765beb07b553e5a36411c0182b4854_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_f12c35fa5934fabb7dbb2086370d6a2fe4279234cd9bcfc02b46791506d41747 = $this->env->getExtension("native_profiler");
        $__internal_f12c35fa5934fabb7dbb2086370d6a2fe4279234cd9bcfc02b46791506d41747->enter($__internal_f12c35fa5934fabb7dbb2086370d6a2fe4279234cd9bcfc02b46791506d41747_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('routing')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_f12c35fa5934fabb7dbb2086370d6a2fe4279234cd9bcfc02b46791506d41747->leave($__internal_f12c35fa5934fabb7dbb2086370d6a2fe4279234cd9bcfc02b46791506d41747_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/router.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 13,  67 => 12,  56 => 7,  53 => 6,  47 => 5,  36 => 3,  11 => 1,);
    }
}
/* {% extends '@WebProfiler/Profiler/layout.html.twig' %}*/
/* */
/* {% block toolbar %}{% endblock %}*/
/* */
/* {% block menu %}*/
/* <span class="label">*/
/*     <span class="icon">{{ include('@WebProfiler/Icon/router.svg') }}</span>*/
/*     <strong>Routing</strong>*/
/* </span>*/
/* {% endblock %}*/
/* */
/* {% block panel %}*/
/*     {{ render(path('_profiler_router', { token: token })) }}*/
/* {% endblock %}*/
/* */

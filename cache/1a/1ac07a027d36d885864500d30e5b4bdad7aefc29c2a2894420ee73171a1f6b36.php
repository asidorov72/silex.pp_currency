<?php

/* forms/fields.html.twig */
class __TwigTemplate_2b1517cf4c9ca0cf61c4aa42fff533f8364713bdee841e112320d650e17a4d44 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'field_row' => array($this, 'block_field_row'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $this->displayBlock('field_row', $context, $blocks);
    }

    public function block_field_row($context, array $blocks = array())
    {
        // line 3
        echo "<div class=\"row\">
    ";
        // line 4
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getContext($context, "form"), 'errors');
        echo "
    ";
        // line 5
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getContext($context, "form"), 'label');
        echo "
    ";
        // line 6
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getContext($context, "form"), 'widget', array("attr" => array("class" => "c4")));
        echo "
</div>
";
    }

    public function getTemplateName()
    {
        return "forms/fields.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 6,  33 => 5,  29 => 4,  26 => 3,  20 => 2,);
    }
}
/* {# src/PP_Currency/Views/forms/widgets.html.twig #}*/
/* {% block field_row %}*/
/* <div class="row">*/
/*     {{ form_errors(form) }}*/
/*     {{ form_label(form) }}*/
/*     {{ form_widget(form, { 'attr': {'class': 'c4'} }) }}*/
/* </div>*/
/* {% endblock field_row %}*/

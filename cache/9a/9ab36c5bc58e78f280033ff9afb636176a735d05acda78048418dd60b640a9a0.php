<?php

/* forms/widgets.html.twig */
class __TwigTemplate_b429e389da9b43a08138690286a449a16176a1abad3b38905e348665a3eff3cb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("form_div_layout.html.twig", "forms/widgets.html.twig", 2);
        $this->blocks = array(
            '_currencyForm_inputText_widget' => array($this, 'block__currencyForm_inputText_widget'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "form_div_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block__currencyForm_inputText_widget($context, array $blocks = array())
    {
        // line 5
        echo "    ";
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter($this->getContext($context, "type"), "text")) : ("text"));
        // line 6
        echo "    <input type=\"";
        echo twig_escape_filter($this->env, $this->getContext($context, "type"), "html", null, true);
        echo "\" ";
        $this->displayBlock("widget_attributes", $context, $blocks);
        echo " value=\"";
        echo twig_escape_filter($this->env, $this->getContext($context, "value"), "html", null, true);
        echo "\" class=\"c4\" />
";
    }

    public function getTemplateName()
    {
        return "forms/widgets.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  34 => 6,  31 => 5,  28 => 4,  11 => 2,);
    }
}
/* {# src/PP_Currency/Views/forms/widgets.html.twig #}*/
/* {% extends 'form_div_layout.html.twig' %}*/
/* */
/* {% block _currencyForm_inputText_widget %}*/
/*     {% set type = type|default('text') %}*/
/*     <input type="{{ type }}" {{ block('widget_attributes') }} value="{{ value }}" class="c4" />*/
/* {% endblock %}*/

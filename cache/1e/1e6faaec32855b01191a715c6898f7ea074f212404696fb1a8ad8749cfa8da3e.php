<?php

/* /index.html.twig */
class __TwigTemplate_216ab9a5c11fdecadf46dcfc3aa3445e8757e852caea9406313d0f1d305fc0f5 extends Twig_Template
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
        echo "<!doctype html>
<!--[if lt IE 7]> <html class=\"no-js lt-ie9 lt-ie8 lt-ie7\" lang=\"en\"> <![endif]-->
<!--[if IE 7]>    <html class=\"no-js lt-ie9 lt-ie8\" lang=\"en\"> <![endif]-->
<!--[if IE 8]>    <html class=\"no-js lt-ie9\" lang=\"en\"> <![endif]-->
<!--[if gt IE 8]><!--> <html class=\"no-js\" lang=\"en\"> <!--<![endif]-->
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
    <title>PP Currency :: index</title>
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">
    <link rel=\"stylesheet\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request", array()), "getSchemeAndHttpHost", array()), "html", null, true);
        echo "/assets/css/style.css\">
</head>

<body>
    ";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session", array()), "getFlashBag", array()), "get", array(0 => "alerts"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["errors"]) {
            // line 17
            echo "    <div data-alert class=\"alert-box ";
            echo $context["errors"];
            echo "\">
       <ul>
            ";
            // line 19
            if ($this->getAttribute($context["errors"], "alert", array(), "array", true, true)) {
                // line 20
                echo "                ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["errors"], "alert", array(), "array"));
                foreach ($context['_seq'] as $context["key"] => $context["error"]) {
                    // line 21
                    echo "                <li style=\"color:red\">";
                    echo $context["error"];
                    echo "</li>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['error'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 23
                echo "            ";
            }
            // line 24
            echo "            ";
            if ($this->getAttribute($context["errors"], "notice", array(), "array", true, true)) {
                // line 25
                echo "                ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["errors"], "notice", array(), "array"));
                foreach ($context['_seq'] as $context["key"] => $context["error"]) {
                    // line 26
                    echo "                <li style=\"color:green\">";
                    echo $context["error"];
                    echo "</li>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['error'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 28
                echo "            ";
            }
            // line 29
            echo "       </ul>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['errors'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 32
        echo "  
       
    ";
        // line 34
        if (twig_length_filter($this->env, $this->getContext($context, "resultRates"))) {
            echo " 
    ";
            // line 35
            echo twig_var_dump($this->env, $context, $this->getContext($context, "resultRates"));
            echo "
    ";
        }
        // line 37
        echo "    
    
    ";
        // line 39
        echo         $this->env->getExtension('form')->renderer->renderBlock($this->getContext($context, "form"), 'form_start', array("name" => "currencyForm", "method" => "post"));
        echo "
    
    ";
        // line 41
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getContext($context, "form"), 'widget', array("attr" => array("class" => "currency_form")));
        echo "
 
    <div>
    ";
        // line 44
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "form"), "amount", array()), 'row', array("label" => "Currency I have: ", "label_attr" => array("class" => "label")));
        echo "
    ";
        // line 45
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "form"), "amount", array()), 'widget');
        echo "
    </div>
   
    <div>
    ";
        // line 49
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "form"), "currencyFrom", array()), 'row', array("label" => "Currency I have: ", "label_attr" => array("class" => "label")));
        echo "
    ";
        // line 50
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "form"), "currencyFrom", array()), 'widget');
        echo "
    </div>
    
    <div>
    ";
        // line 54
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "form"), "currencyTo", array()), 'row', array("label" => "Currency I want: ", "label_attr" => array("class" => "label")));
        echo "
    ";
        // line 55
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "form"), "currencyTo", array()), 'widget');
        echo "
    </div>
    
    <div>
    ";
        // line 59
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "form"), "convert", array()), 'widget', array("attr" => array("class" => "button")));
        echo "
    </div>
    
    ";
        // line 62
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getContext($context, "form"), 'rest');
        echo "
    ";
        // line 63
        echo         $this->env->getExtension('form')->renderer->renderBlock($this->getContext($context, "form"), 'form_end');
        echo "

</body>
</html>";
    }

    public function getTemplateName()
    {
        return "/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  167 => 63,  163 => 62,  157 => 59,  150 => 55,  146 => 54,  139 => 50,  135 => 49,  128 => 45,  124 => 44,  118 => 41,  113 => 39,  109 => 37,  104 => 35,  100 => 34,  96 => 32,  88 => 29,  85 => 28,  76 => 26,  71 => 25,  68 => 24,  65 => 23,  56 => 21,  51 => 20,  49 => 19,  43 => 17,  39 => 16,  32 => 12,  19 => 1,);
    }
}
/* <!doctype html>*/
/* <!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->*/
/* <!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->*/
/* <!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->*/
/* <!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->*/
/* <head>*/
/*     <meta charset="utf-8">*/
/*     <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">*/
/*     <title>PP Currency :: index</title>*/
/*     <meta name="description" content="">*/
/*     <meta name="author" content="">*/
/*     <link rel="stylesheet" href="{{ app.request.getSchemeAndHttpHost }}/assets/css/style.css">*/
/* </head>*/
/* */
/* <body>*/
/*     {% for errors in app.session.getFlashBag.get('alerts') %}*/
/*     <div data-alert class="alert-box {{ errors|raw }}">*/
/*        <ul>*/
/*             {% if errors['alert'] is defined %}*/
/*                 {% for key, error in errors['alert'] %}*/
/*                 <li style="color:red">{{ error|raw }}</li>*/
/*                 {% endfor %}*/
/*             {% endif %}*/
/*             {% if errors['notice'] is defined %}*/
/*                 {% for key, error in errors['notice'] %}*/
/*                 <li style="color:green">{{ error|raw }}</li>*/
/*                 {% endfor %}*/
/*             {% endif %}*/
/*        </ul>*/
/*     </div>*/
/*     {% endfor %}*/
/*   */
/*        */
/*     {% if resultRates|length %} */
/*     {{ dump(resultRates) }}*/
/*     {% endif %}*/
/*     */
/*     */
/*     {{ form_start(form, {'name' : 'currencyForm', 'method' : 'post'}) }}*/
/*     */
/*     {{ form_widget(form, { 'attr': {'class': 'currency_form'}}) }}*/
/*  */
/*     <div>*/
/*     {{ form_row(form.amount, {'label': 'Currency I have: ', 'label_attr': {'class': 'label'}}) }}*/
/*     {{ form_widget(form.amount) }}*/
/*     </div>*/
/*    */
/*     <div>*/
/*     {{ form_row(form.currencyFrom, {'label': 'Currency I have: ', 'label_attr': {'class': 'label'}}) }}*/
/*     {{ form_widget(form.currencyFrom) }}*/
/*     </div>*/
/*     */
/*     <div>*/
/*     {{ form_row(form.currencyTo, {'label': 'Currency I want: ', 'label_attr': {'class': 'label'}}) }}*/
/*     {{ form_widget(form.currencyTo) }}*/
/*     </div>*/
/*     */
/*     <div>*/
/*     {{ form_widget(form.convert, { 'attr': {'class': 'button'}}) }}*/
/*     </div>*/
/*     */
/*     {{ form_rest(form) }}*/
/*     {{ form_end(form) }}*/
/* */
/* </body>*/
/* </html>*/

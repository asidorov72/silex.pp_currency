<?php

/* /index.html.twig */
class __TwigTemplate_1f522ea9d9fbafaa893c33009c7c548ae0a4804f22fe3a2a8f7c012a04b95b6c extends Twig_Template
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
        // line 17
        echo twig_escape_filter($this->env, $this->getContext($context, "test_hello_var"), "html", null, true);
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
        return array (  40 => 17,  32 => 12,  19 => 1,);
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
/*     */
/*     {{ test_hello_var }}*/
/* */
/* </body>*/
/* </html>*/

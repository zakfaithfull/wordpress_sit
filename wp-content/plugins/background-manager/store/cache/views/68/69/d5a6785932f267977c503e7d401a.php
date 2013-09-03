<?php

/* meta_gallery_css.html.twig */
class __TwigTemplate_6869d5a6785932f267977c503e7d401a extends Twig_Template
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
        // line 7
        echo "
<p id=\"custom_css_desc\">
    <label for=\"custom_css\">
        ";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("You can provide an additional Custom Stylesheet (CSS) that will only be loaded when this Image Set is active."), "html", null, true);
        echo "
        ";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("As an example, this could be used to match the colors of the "), "html", null, true);
        echo "<em>";
        if (isset($context["theme_name"])) { $_theme_name_ = $context["theme_name"]; } else { $_theme_name_ = null; }
        echo twig_escape_filter($this->env, $_theme_name_, "html", null, true);
        echo "</em>";
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter(" theme with those of the images."), "html", null, true);
        echo "
    </label>
</p>
<textarea id=\"custom_css\" name=\"custom_css\" class=\"code\" rows=\"10\" cols=\"200\" style=\"width:100%;\" tabindex=\"3\" wrap=\"off\">";
        // line 14
        if (isset($context["custom_css"])) { $_custom_css_ = $context["custom_css"]; } else { $_custom_css_ = null; }
        echo twig_escape_filter($this->env, $_custom_css_, "html", null, true);
        echo "</textarea>

";
    }

    public function getTemplateName()
    {
        return "meta_gallery_css.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 14,  28 => 11,  24 => 10,  37 => 14,  33 => 13,  27 => 10,  23 => 9,  19 => 7,);
    }
}

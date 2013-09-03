<?php

/* meta_gallery_tags.html.twig */
class __TwigTemplate_a7755a84d0ed282f029eff587e64de80 extends Twig_Template
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
";
        // line 8
        $context["me"] = $this->env->loadTemplate("macros_edit.html.twig");
        // line 9
        echo "
<div id=\"tagsdiv-post_tag\" style=\"border-bottom:1px solid #dfdfdf;padding-bottom:10px;\">
    <p>
        ";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Override the default Image Set with this one, if a post contains one or more of the selected tags:"), "html", null, true);
        echo "
    </p>

    <div class=\"tagsdiv\" id=\"post_tag\">
        <div class=\"nojs-tags hide-if-js\">
            <p>
                Add or remove tags
            </p>
            <textarea name=\"tax_input[post_tag]\" rows=\"3\" cols=\"20\" class=\"the-tags\" id=\"tax-input-post_tag\" >";
        // line 20
        if (isset($context["tags"])) { $_tags_ = $context["tags"]; } else { $_tags_ = null; }
        echo twig_escape_filter($this->env, $_tags_, "html", null, true);
        echo "</textarea>
        </div>
        <div class=\"ajaxtag hide-if-no-js\">
            <p>
                <input type=\"text\" id=\"new-tag-post_tag\" name=\"newtag[post_tag]\" class=\"newtag form-input-tip\" size=\"16\" autocomplete=\"off\" value=\"\" />
                <input type=\"button\" class=\"button tagadd\" value=\"Add\" />
            </p>
        </div>

        <p class=\"howto\">Separate tags with commas</p>

        <div class=\"tagchecklist\"></div>
    </div>
</div>

<div id=\"overlaytagdiv\" style=\"border-top:1px solid #fff;\">
    <p>
        ";
        // line 37
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Optionally override the overlay and color:"), "html", null, true);
        echo "
    </p>
    <div>
        ";
        // line 40
        if (isset($context["me"])) { $_me_ = $context["me"]; } else { $_me_ = null; }
        if (isset($context["background_color"])) { $_background_color_ = $context["background_color"]; } else { $_background_color_ = null; }
        echo $_me_->getfarbtastic_input("tag", $_background_color_);
        echo "
    </div>
    <p>
        <select id=\"overlay_tag_override\" class=\"postform\" name=\"overlay_tag_override\">
            ";
        // line 44
        if (isset($context["overlays"])) { $_overlays_ = $context["overlays"]; } else { $_overlays_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_overlays_);
        foreach ($context['_seq'] as $context["_key"] => $context["overlay"]) {
            // line 45
            echo "            <option ";
            if (isset($context["overlay"])) { $_overlay_ = $context["overlay"]; } else { $_overlay_ = null; }
            if ($this->getAttribute($_overlay_, "selected")) {
                echo "selected=\"selected\"";
            }
            echo " value=\"";
            if (isset($context["overlay"])) { $_overlay_ = $context["overlay"]; } else { $_overlay_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_overlay_, "value"), "html", null, true);
            echo "\">";
            if (isset($context["overlay"])) { $_overlay_ = $context["overlay"]; } else { $_overlay_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_overlay_, "desc"), "html", null, true);
            echo "</option>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['overlay'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 47
        echo "        </select>
    </p>
</div>

";
        // line 51
        if (isset($context["me"])) { $_me_ = $context["me"]; } else { $_me_ = null; }
        echo $_me_->getfarbtastic_script("tag");
        echo "
";
    }

    public function getTemplateName()
    {
        return "meta_gallery_tags.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  105 => 51,  99 => 47,  81 => 45,  76 => 44,  67 => 40,  61 => 37,  190 => 47,  184 => 43,  166 => 41,  161 => 40,  152 => 36,  146 => 33,  139 => 28,  120 => 24,  115 => 23,  104 => 22,  86 => 21,  83 => 20,  55 => 18,  29 => 12,  22 => 8,  88 => 35,  85 => 34,  72 => 31,  69 => 30,  66 => 29,  57 => 24,  53 => 23,  50 => 22,  40 => 20,  36 => 16,  26 => 12,  39 => 14,  28 => 11,  24 => 9,  37 => 17,  33 => 15,  27 => 10,  23 => 9,  19 => 7,);
    }
}

<?php

/* meta_gallery_categories.html.twig */
class __TwigTemplate_01eb7de51a6acbb66a83caa79a223db3 extends Twig_Template
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
<div id=\"catdiv\" style=\"border-bottom:1px solid #dfdfdf;padding-bottom:10px;\">
    <p>
        ";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Override the default Image Set with this one, if a post belongs to one or more of the selected categories:"), "html", null, true);
        echo "
    </p>

    <div id=\"taxonomy-category\" class=\"categorydiv\">
        <ul id=\"category-tabs\" class=\"category-tabs\">
            ";
        // line 17
        if (isset($context["categories"])) { $_categories_ = $context["categories"]; } else { $_categories_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_categories_);
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["category_key"] => $context["category"]) {
            // line 18
            echo "            <li class=\"";
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            if ($this->getAttribute($_loop_, "first")) {
                echo "tabs";
            } else {
                echo "hide-if-no-js";
            }
            echo "\"><a href=\"#category-";
            if (isset($context["category_key"])) { $_category_key_ = $context["category_key"]; } else { $_category_key_ = null; }
            echo twig_escape_filter($this->env, $_category_key_, "html", null, true);
            echo "\">";
            if (isset($context["category"])) { $_category_ = $context["category"]; } else { $_category_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_category_, "label"), "html", null, true);
            echo "</a></li>
            ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['category_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 20
        echo "        </ul>
        ";
        // line 21
        if (isset($context["categories"])) { $_categories_ = $context["categories"]; } else { $_categories_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_categories_);
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["category_key"] => $context["category"]) {
            // line 22
            echo "        <div id=\"category-";
            if (isset($context["category_key"])) { $_category_key_ = $context["category_key"]; } else { $_category_key_ = null; }
            echo twig_escape_filter($this->env, $_category_key_, "html", null, true);
            echo "\" class=\"tabs-panel\" ";
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            if ((!$this->getAttribute($_loop_, "first"))) {
                echo "style=\"display: none;\"";
            }
            echo ">
            <ul id=\"categorychecklist-";
            // line 23
            if (isset($context["category_key"])) { $_category_key_ = $context["category_key"]; } else { $_category_key_ = null; }
            echo twig_escape_filter($this->env, $_category_key_, "html", null, true);
            echo "\" class=\"categorychecklist form-no-clear\">
                ";
            // line 24
            if (isset($context["category"])) { $_category_ = $context["category"]; } else { $_category_ = null; }
            echo $this->getAttribute($_category_, "checklist");
            echo "
            </ul>
        </div>
        ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['category_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 28
        echo "    </div>
</div>

<div id=\"overlaycatdiv\" style=\"border-top:1px solid #fff;\">
    <p>
        ";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Optionally override the overlay and color:"), "html", null, true);
        echo "
    </p>
    <div>
        ";
        // line 36
        if (isset($context["me"])) { $_me_ = $context["me"]; } else { $_me_ = null; }
        if (isset($context["background_color"])) { $_background_color_ = $context["background_color"]; } else { $_background_color_ = null; }
        echo $_me_->getfarbtastic_input("cat", $_background_color_);
        echo "
    </div>
    <p> 
        <select id=\"overlay_cat_override\" class=\"postform\" name=\"overlay_cat_override\">
            ";
        // line 40
        if (isset($context["overlays"])) { $_overlays_ = $context["overlays"]; } else { $_overlays_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_overlays_);
        foreach ($context['_seq'] as $context["_key"] => $context["overlay"]) {
            // line 41
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
        // line 43
        echo "        </select>
    </p>
</div>

";
        // line 47
        if (isset($context["me"])) { $_me_ = $context["me"]; } else { $_me_ = null; }
        echo $_me_->getfarbtastic_script("cat");
        echo "
";
    }

    public function getTemplateName()
    {
        return "meta_gallery_categories.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  190 => 47,  184 => 43,  166 => 41,  161 => 40,  152 => 36,  146 => 33,  139 => 28,  120 => 24,  115 => 23,  104 => 22,  86 => 21,  83 => 20,  55 => 18,  29 => 12,  22 => 8,  88 => 35,  85 => 34,  72 => 31,  69 => 30,  66 => 29,  57 => 24,  53 => 23,  50 => 22,  40 => 18,  36 => 16,  26 => 12,  39 => 14,  28 => 11,  24 => 9,  37 => 17,  33 => 15,  27 => 10,  23 => 9,  19 => 7,);
    }
}

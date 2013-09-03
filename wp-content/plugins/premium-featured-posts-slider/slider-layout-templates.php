<?php
/*
  Premium Featured Posts Slider Templates
  Copyright 2011. Web factory Ltd
*/

$layouts['layout-1'] = <<<EOT
<div class="fps-full-img">
  <a href="{permalink}">
  <div>
    {thumbnail}
    <h2 class="entry-title fps-entry-title">{title}</h2>
  </div>
  </a>
</div>
EOT;

$layouts['layout-2'] = <<<EOT
<h2 class="entry-title">
  <a href="{permalink}">{title}</a>
</h2>
<div class="fps-thumb">
  <a href="{permalink}">{thumbnail}</a>
</div>
<div class="fps-block">
  {content}
  <small class="entry-utility"><strong>Written by</strong> {author} <strong>on</strong> {date} @ {time}<br /><strong>Filed under:</strong> {categories}</small>
</div>
EOT;

$layouts['layout-3'] = <<<EOT
<div class="fps-thumb">
  <a href="{permalink}">{thumbnail}</a>
</div>
<div>
  <h2 class="entry-title"><a href="{permalink}">{title}</a></h2>
  {content}
  <small class="entry-utility"><strong>Written by</strong> {author} <strong>on</strong> {date} @ {time}<br /><strong>Filed under:</strong> {categories}</small>
</div>
EOT;

$layouts['layout-4'] = <<<EOT
<div class="fps-full-img">
  <a href="{permalink}">
    <h2 class="entry-title">{title}</h2>
    {thumbnail}
  </a>
</div>
EOT;

$layouts['layout-5'] = <<<EOT
<h2 class="entry-title">
  <a href="{permalink}">{title}</a>
</h2>
<div class="fps-thumb-right">
  <a href="{permalink}">{thumbnail}</a>
</div>
<div class="fps-block">{content}
  <small class="entry-utility"><strong>Written by</strong> {author} <strong>on</strong> {date} @ {time}<br /><strong>Filed under:</strong> {categories}</small>
</div>
EOT;

$layouts['layout-6'] = <<<EOT
<div class="fps-thumb-right">
  <a href="{permalink}">{thumbnail}</a>
</div>
<div>
  <h2 class="entry-title"><a href="{permalink}">{title}</a></h2>
  {content}
  <small class="entry-utility"><strong>Written by</strong> {author} <strong>on</strong> {date} @ {time}<br /><strong>Filed under:</strong> {categories}</small>
</div>
EOT;
?>
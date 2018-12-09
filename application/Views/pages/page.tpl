{include file="../snippets/lists.tpl"}

<html>
  <head>
      <link href="http://{$base_url}res/css/bootstrap.min.css" rel="stylesheet">
      <script src="http://{$base_url}res/js/jquery-3.3.1.min.js"></script>
      <script src="http://{$base_url}res/js/bootstrap.min.js"></script>
      <title>
          {$title}
      </title>
  </head>
  <body>
    {include file="../snippets/nav.tpl"}
    <div class="container">
      {block name="content"}
      {/block}
    </div>
  </body>
</html>
{extends file="./page.tpl"}
{block name="content"}
  <h1>{$heading}</h1>
  {call name="list" items=['item1', 'item2', 'item3']}
{/block}
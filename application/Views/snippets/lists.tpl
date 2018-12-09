{function name="list" items=[]}
  {if !empty($items)}
    <ul>
      {foreach $items as $item}
        <li>{$item}</li>
      {/foreach}
    </ul>  
  {else}
    <h4>Empty list</h4>
  {/if}
{/function}
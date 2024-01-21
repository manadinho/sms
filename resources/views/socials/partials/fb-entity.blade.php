<div class="d-flex flex-row gap-2 border rounded p-2 mb-2 c-pointer {{ (in_array($entity['id'],$connectedSocials)) ? 'entity-active':'' }}" style="cursor: pointer;" data-entity='@json($entity)' onclick="toggleFbEntity(this)">
    <div class="align-self-center">
        <img src="{{ ($type == 'page') ? $entity['picture']['data']['url'] : asset('/images/on-board-fb_group.svg') }}" style="width: 50px;">
    </div>
    <div class="align-self-center">
        <span class="weight-500">{{$entity['name']}}</span>
    </div>
</div>

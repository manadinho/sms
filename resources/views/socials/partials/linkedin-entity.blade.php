<div class="d-flex flex-row gap-2 border rounded p-2 mb-2 c-pointer {{ (in_array($entity['id'],$connectedSocials)) ? 'entity-active':'' }}" style="cursor: pointer;" data-entity='@json($entity)' onclick="toggleLinkedinEntity(this)">
    <div class="align-self-center">
        <img src="{{ ($entity['picture']) ? $entity['picture'] : asset('/images/linkedin.svg') }}" style="width: 50px;">
    </div>
    <div class="align-self-center">
        <span class="weight-500">{{$entity['name']}}</span>
    </div>
</div>

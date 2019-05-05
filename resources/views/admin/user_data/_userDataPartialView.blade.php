<div class="model-data">
        <h3>Пользователь №{{$userModel->getId()}}</h3>
<input type="hidden" id="userId" value="{{$userModel->getId()}}">

    <label for="name">Имя:</label>
    <p> {{$userModel->getFullName()}} </p>

    <label for="name">Роли:</label>
    <ul>
      @foreach ($userModel->getRoles() as $role)
        <p> <li> {{ $role->getName() }} </p>
      @endforeach
    </ul>

</div>

<!-- Modal -->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                Измененение роли пользователя {{$userModel->getFullName()}}
            </div>
            <form id="editUserRolesForm">
                <div class="modal-body">
                    <div class="errors alert alert-danger"><ul></ul></div>
                    <div class="row form-inline">
                        <input type="hidden" name="userId" id='' value="{{$userModel->getId()}}">
                        <div class="form-group">
                            <label for="name">Роли</label>
                            <div class="roles-form">
                                @foreach ( $roles as $role )
                                  @if ( $userModel->getRoles()->contains($role) )
                                  <div><input type="checkbox" name=" {{ $role->getName() }} " id=" {{ $role->getId() }} " value=" {{ $role->getId() }} " checked> {{ $role->getDescription() }} </input></div>
                                  @else
                                  <div><input type="checkbox" name=" {{ $role->getName() }} " id=" {{ $role->getId() }} " value=" {{ $role->getId() }} " > {{ $role->getDescription() }} </input></div>
                                  @endif
                                @endforeach
                            <div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="saveEditRoles">Сохранить</button>
                    <button type="reset" id="cancelEdit" class="btn btn-default" data-dismiss="modal">Отмена</button>
                </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>


</script>

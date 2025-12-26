<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 04178d1b4cda36a2a838469edd267471fd3d5375
<!--
 * Author : Ni Kadek Adelia Paramita Putri (NRP 5026231196)
 * Desc   : Package View Chatify dan beberapa custom manual
-->
<<<<<<< HEAD
>>>>>>> 008e2df50e114cd6f15e972ab9f157700f9bd9b0
=======
>>>>>>> 04178d1b4cda36a2a838469edd267471fd3d5375
<div class="favorite-list-item">
    @if($user)
        <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m"
            style="background-image: url('{{ Chatify::getUserWithAvatar($user)->avatar }}');">
        </div>
        <p>{{ strlen($user->name) > 5 ? substr($user->name,0,6).'..' : $user->name }}</p>
    @endif
</div>

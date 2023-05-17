<link rel="stylesheet" href="../../../public/assets/css/admin.css">

<p>-Admin section-</p>

<!-- <button class="show-admin"><img src="../../../public/assets/img/arrowDown.png" class="arrow-down"/> admin panel</button> -->

<div class="categories">
    <li><img src="../../../public/assets/img/arrowDown.png" class="arrow-down" />категорий</li>
    <div id="category-links" class="links">
        <a href="{{route('categories.index')}}">Список категории</a>
        <a href="{{route('categories.create')}}">Создать категорию</a>
    </div>
</div>
<div class="tags">
    <li><img src="../../../public/assets/img/arrowDown.png" class="arrow-down" />Теги</li>
    <div id="tag-links" class="links">
        <a href="{{route('tags.index')}}">Список тэгов</a>
        <a href="{{route('tags.create')}}">Создать тэг</a>
    </div>
</div>

<div class="container">
<h1>Калькулятор v0.02</h1>
<div class="row">
    <div class="col-6">
        <form action="" method="post">
            <div class="mb-3" id="a1">
                <label  class="form-label">введите число A</label>
                <input type="text" class="form-control" name="a">
            </div>
            <div class="mb-3">
                <label  class="form-label">введите число B</label>
                <input type="text" class="form-control" name="b">
                <input type="hidden"name="pages" value="calc">
            </div>
            <div class="mb-3">
                <select class="form-select" name="action">
                    <option value="+">+</option>
                    <option value="-">-</option>
                    <option value="*">*</option>
                    <option value="/">/</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="btnCalc">Посчитать</button>
        </form>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                Результат:<br>
                <?php
//                    require_once("includes/function.php");
                    echo calc();
                ?>

            </div>
        </div>
    </div>
</div>
</div>

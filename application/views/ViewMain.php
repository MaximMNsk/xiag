<script src="assets/js/main-form-manage.js"></script>
<script src="assets/js/main-form-req.js"></script>
<div class="container m-5 p-3 mx-auto border">
    <div class="card">
        <div class="card-header">
            <span class="col-5">Question:</span>
            <span><input  class="col-10 form-control d-inline" type="text" id="question"></span>
        </div>
        <div class="card-body">
            <div id="items">
                <span ans-id="1">
                    <span class="col-5">Answer 1:</span>
                    <span><input  class="col-10 form-control d-inline" type="text" id="answer-1"></span>
                    <hr>
                </span>
                <span ans-id="2">
                    <span class="col-5">Answer 2:</span>
                    <span><input  class="col-10 form-control d-inline" type="text" id="answer-2"></span>
                    <hr>
                </span>
            </div>
            <span class="col-5" id="add-item"><button class="btn btn-success">+</button></span>
            <span></span>
            <hr>
            <span id="message" class="w-5"></span>
            <button class="btn btn-success" id="save">START</button>
        </div>
    </div>
</div>
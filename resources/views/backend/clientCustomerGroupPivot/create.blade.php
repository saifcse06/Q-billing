<div class="row">
    <div class="col-md-offset-2 col-lg-7">
        <section class="panel">
            <header class="panel-heading">
                Add Customers in Group
                <button class="btn btn-primary pull-right" id="add-modal"> Add New Customer</button>
            </header>
            <div class="panel-body">
                @include('layouts.backend._validationErrorMessages')
                {!! Form::open(['route'=>'client_customer_group_pivot.store','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                @include('backend.clientCustomerGroupPivot._form')
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        {!! Form::submit('Create',['class'=>'btn btn-success btnCreate pull-right']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </section>
    </div>
</div>

<!-- Modal form to add a Customer -->
<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Name<sup> <span class="red">*</span></sup>:</label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control" id="name" autofocus placeholder="Enter Customer Name" autofocus>

                            <p class="errorTitle text-center alert alert-danger hidden"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Email<sup> <span class="red">*</span></sup>:</label>
                        <div class="col-sm-10">
                            <input type="email" required class="form-control" id="email" autofocus placeholder="Enter Email">

                            <p class="errorTitle text-center alert alert-danger hidden"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Mobile<sup> <span class="red">*</span></sup>:</label>
                        <div class="col-sm-10">
                            <input type="number" required class="form-control" id="phone" placeholder="Enter Mobile Number">

                            <p class="errorTitle text-center alert alert-danger hidden"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="content">Address:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="address" id="address" cols="40" rows="3"></textarea>
                            {{--<small>Min: 2, Max: 128, only text</small>--}}
                            <p class="errorContent text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success add" data-dismiss="modal">
                        <span id="" class='fa fa-check'></span> Add
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='fa fa-times'></span> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

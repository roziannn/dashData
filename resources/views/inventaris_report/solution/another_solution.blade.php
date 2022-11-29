{{-- add solution by another user // solution_2 --}}
<div class="col-auto">
    <div class="text-right mb-3 mt-5">
        <a href="#" style="text-decoration: none" class="btn-sm btn-warning" data-toggle="modal"
            data-target="#modal-primary"> Add your Solution</a>
    </div>
</div>

<div class="modal fade" id="modal-primary">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Give a solution</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/inventaris/report/solution-add' . $data->id) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <input class="form-control form-control-user col-sm-4 mb-3" name='executor' id='executor'
                            type="hidden" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
                        <input class="form-control form-control-user col-sm-4 mb-3" name='status' id='status'
                            type="hidden" value="1">
                        <div class="col-md-12 mb-3">
                            <label class="small mb-1 mr-5" for="service_type">Service Type</label>
                            <select class="form-control input-sm" name="service_type" id="service_type">
                                <option value="Self Service">Self Service</option>
                                <option value="Vendor">Vendor</option>
                            </select>

                            {{-- script other value --}}
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                            <script type="text/javascript">
                                var otherInput;
                                var startService, endService;
                                var serviceTypeInput = $('#service_type');
                                serviceTypeInput.on('change', function() {
                                    otherInput = $('#vendor_name');
                                    startService = $('#start_service');
                                    endService = $('#end_service');
                                    if (serviceTypeInput.val() == "Vendor") {
                                        otherInput.show();
                                        startService.show();
                                        endService.show();
                                    } else {
                                        otherInput.hide();
                                        startService.hide();
                                        endService.hide();
                                    }
                                });
                            </script>
                        </div>
                        {{-- other field --}}
                        <div class="col-sm-4 mb-3">
                            {{-- <label class="small mb-1 mr-5" for="vendor">Vendor Name</label> --}}
                            <input class="form-control form-control-user" name='vendor_name' id='vendor_name'
                                type="text" placeholder="Vendor Name" title="Vendor Name" style="display: none">
                        </div>
                        <div class="col-sm-4">
                            {{-- tanggal --}}
                            {{-- <label class="small mb-1 mr-5" for="start_service">Start Date</label> --}}
                            <input type="date" class="form-control" id="start_service" name="start_service"
                                title="Start service date" style="display: none">
                        </div>
                        <div class="col-sm-4">
                            {{-- <label class="small mb-1 mr-5" for="end_service">End Date</label> --}}
                            <input type="date" class="form-control" id="end_service" name="end_service"
                                title="End service date" style="display: none">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="small mb-1" for="solution">Solution</label>
                            <textarea id="solution" name="solution" class="form-control input-sm required" placeholder="Description" value=""
                                rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm pull-left"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

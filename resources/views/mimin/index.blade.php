@extends('mimin.master')
@section('title', 'Calova Mimin - Dashboard')
@section('content')

<div class="btn-controls">
                                <div class="btn-box-row row-fluid">
                                    <a href="#" class="btn-box big span4"><i class="icon-bullhorn"></i><b>{{ $event }}</b>
                                        <p class="text-muted">
                                            Total Event</p>
                                    </a><a href="#" class="btn-box big span4"><i class="icon-user"></i><b>{{ $total }}</b>
                                        <p class="text-muted">
                                            Total Users</p>
                                    </a><a href="#" class="btn-box big span4"><i class="icon-money"></i><b>-</b>
                                        <p class="text-muted">
                                            Profit</p>
                                    </a>
                                </div>
                              </div>
                            <!--/#btn-controls-->

                            <div class="module hide">
                                <div class="module-head">
                                    <h3>
                                        Adjust Budget Range</h3>
                                </div>
                                <div class="module-body">
                                    <div class="form-inline clearfix">
                                        <a href="#" class="btn pull-right">Update</a>
                                        <label for="amount">
                                            Price range:</label>
                                        &nbsp;
                                        <input type="text" id="amount" class="input-" />
                                    </div>
                                    <hr />
                                    <div class="slider-range">
                                    </div>
                                </div>
                            </div>
@stop
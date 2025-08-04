@extends('layouts.app')

@section('page-title', 'Inbox')

@section('content-main')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Inbox</h3>

            <div class="card-tools">
                <form action="{{ route('inbox.index') }}" method="GET">
                    <div class="input-group input-group-sm">
                        <input class="form-control" name="search" placeholder="Search Mail" type="text" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="mailbox-controls">
                <!-- Check all button -->
                <button class="btn btn-default btn-sm checkbox-toggle" type="button"><i class="far fa-square"></i>
                </button>
                <div class="btn-group">
                    <button class="btn btn-default btn-sm" type="button">
                        <i class="far fa-trash-alt"></i>
                    </button>
                    <button class="btn btn-default btn-sm" type="button">
                        <i class="fas fa-reply"></i>
                    </button>
                    <button class="btn btn-default btn-sm" type="button">
                        <i class="fas fa-share"></i>
                    </button>
                </div>
                <!-- /.btn-group -->
                <button class="btn btn-default btn-sm" type="button">
                    <i class="fas fa-sync-alt"></i>
                </button>
            <div class="float-right">
                Showing {{ $inboxes->firstItem() }} to {{ $inboxes->lastItem() }} of {{ $inboxes->total() }} entries
            </div>
                <!-- /.float-right -->
            </div>
            <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                    <tbody>
                        @foreach ($inboxes as $inbox)
                            <tr>
                                <td>
                                    <div class="icheck-primary">
                                        <input type="checkbox" value="" id="check{{ $loop->iteration }}">
                                        <label for="check{{ $loop->iteration }}"></label>
                                    </div>
                                </td>
                                <td class="mailbox-star"><a href="#"><i class="fas fa-star text-warning"></i></a></td>
                                <td class="mailbox-name"><a href="{{ route('inbox.show', $inbox) }}">{{ $inbox->inbox_nama }}</a></td>
                                <td class="mailbox-subject"><b>{{ $inbox->inbox_perihal }}</b> -
                                    {{ Str::limit($inbox->inbox_isi, 50) }}
                                </td>
                                <td class="mailbox-attachment"></td>
                                <td class="mailbox-date">{{ $inbox->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- /.table -->
            </div>
            <!-- /.mail-box-messages -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer p-0">
            <div class="mailbox-controls">
                <!-- Check all button -->
                <button class="btn btn-default btn-sm checkbox-toggle" type="button">
                    <i class="far fa-square"></i>
                </button>
                <div class="btn-group">
                    <button class="btn btn-default btn-sm" type="button">
                        <i class="far fa-trash-alt"></i>
                    </button>
                    <button class="btn btn-default btn-sm" type="button">
                        <i class="fas fa-reply"></i>
                    </button>
                    <button class="btn btn-default btn-sm" type="button">
                        <i class="fas fa-share"></i>
                    </button>
                </div>
                <!-- /.btn-group -->
                <button class="btn btn-default btn-sm" type="button">
                    <i class="fas fa-sync-alt"></i>
                </button>
                <div class="float-right">
                    Showing {{ $inboxes->firstItem() }} to {{ $inboxes->lastItem() }} of {{ $inboxes->total() }} entries
                    {{ $inboxes->links('vendor.pagination.bootstrap-4') }}
                </div>
                <!-- /.float-right -->
            </div>
        </div>
    </div>
@endsection

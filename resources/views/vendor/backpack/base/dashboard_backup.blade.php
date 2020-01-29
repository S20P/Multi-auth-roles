@extends(backpack_view('blank'))

@php
	$userCount = App\Models\BackpackUser::count();
	$SupplierCount = App\Models\Supplier::count();	
	$CustomerCount = App\Models\Customer::count();
	$lastArticle = \Backpack\NewsCRUD\app\Models\Article::orderBy('date', 'DESC')->first();
	$lastArticleDaysAgo = \Carbon\Carbon::parse($lastArticle->date)->diffInDays(\Carbon\Carbon::today());

@endphp

	@if(backpack_user()->hasRole('admin'))
	@php
	$widgets['before_content'][] = [
	  'type' => 'div',
	  'class' => 'row',
	  'content' => [ // widgets 
	        [
			    'type'        => 'progress',
			    'class'       => 'card text-white bg-primary mb-2',
			    'value'       => $userCount,
			    'description' => 'Registered users.',
			    'progress'    => (int)$userCount/10*100, // integer
			    'hint'        => 10-$userCount.' more until next milestone.',
			],
			[
			    'type'        => 'progress',
			    'class'       => 'card text-white bg-warning mb-2',
			    'value'       => $SupplierCount,
			    'description' => 'supplier.',
			    'progress'    => (int)$SupplierCount/75*100, // integer
			    'hint'        => $SupplierCount>75?'Easier to sell less than 75 products.':'Good. Good.',
			],
			[
			    'type'        => 'progress',
			    'class'       => 'card text-white bg-success border-0 mb-2',
			    'value'       => $CustomerCount,
			    'description' => 'customer.',
			    'progress'    => 100, // integer
			    'hint'        => 'Great! Don\'t stop.',
			],
			[
			    'type'        => 'progress',
			    'class'       => 'card text-white '.($lastArticleDaysAgo>5?'bg-danger':'bg-success').' mb-2',
			    'value'       => $lastArticleDaysAgo.' days',
			    'description' => 'Since last article.',
			    'progress'    => 100, // integer
			    'hint'        => 'Post an article every 3-4 days.',
			],
	  ]
	];
	@endphp
   @endif

   @php
    $widgets['before_content'][] = [
        'type'        => 'jumbotron',
        'wrapperClass'=> 'shadow-xs',
        'heading'     => trans('backpack::base.welcome'),
        'content'     => trans('backpack::base.use_sidebar'),
        'button_link' => backpack_url('logout'),
        'button_text' => trans('backpack::base.logout'),
    ];
    $widgets['after_content'][] = [
	  'type' => 'div',
	  'class' => 'row',
	  'content' => [ // widgets 
	       [
			  'type' => 'card',
			  // 'wrapperClass' => 'col-sm-6 col-md-4', // optional
			  // 'class' => 'card bg-dark text-white', // optional
			  'content' => [
			      'header' => 'Some card title', // optional
			      'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis non mi nec orci euismod venenatis. Integer quis sapien et diam facilisis facilisis ultricies quis justo. Phasellus sem <b>turpis</b>, ornare quis aliquet ut, volutpat et lectus. Aliquam a egestas elit. <i>Nulla posuere</i>, sem et porttitor mollis, massa nibh sagittis nibh, id porttitor nibh turpis sed arcu.',
			  ]
			],
			[
			  'type' => 'card',
			  // 'wrapperClass' => 'col-sm-6 col-md-4', // optional
			  // 'class' => 'card bg-dark text-white', // optional
			  'content' => [
			      'header' => 'Another card title', // optional
			      'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis non mi nec orci euismod venenatis. Integer quis sapien et diam facilisis facilisis ultricies quis justo. Phasellus sem <b>turpis</b>, ornare quis aliquet ut, volutpat et lectus. Aliquam a egestas elit. <i>Nulla posuere</i>, sem et porttitor mollis, massa nibh sagittis nibh, id porttitor nibh turpis sed arcu.',
			  ]
			],
			[
			  'type' => 'card',
			  // 'wrapperClass' => 'col-sm-6 col-md-4', // optional
			  // 'class' => 'card bg-dark text-white', // optional
			  'content' => [
			      'header' => 'Yet another card title', // optional
			      'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis non mi nec orci euismod venenatis. Integer quis sapien et diam facilisis facilisis ultricies quis justo. Phasellus sem <b>turpis</b>, ornare quis aliquet ut, volutpat et lectus. Aliquam a egestas elit. <i>Nulla posuere</i>, sem et porttitor mollis, massa nibh sagittis nibh, id porttitor nibh turpis sed arcu.',
			  ]
			],
	  ]
	];
    $widgets['after_content'][] = [
	  'type'         => 'alert',
	  'class'        => 'alert alert-warning bg-dark border-0 mb-2',
	  'heading'      => 'Demo Refreshes Every Hour on the Hour',
	  'content'      => 'At hh:00, all custom entries are deleted, all files, everything. This cleanup is necessary because developers like to joke with their test entries, and mess with stuff. But you know that :-) Go ahead - make a developer smile.' ,
	  'close_button' => true, // show close button or not
	];
@endphp

@section('content')

@if(backpack_user()->hasRole('supplier'))

<h2>supplier Dashbord here</h2>

@elseif(backpack_user()->hasRole('customer'))

<h2> customer Dashbord here</h2>

@elseif(backpack_user()->hasRole('admin'))

<h2> Admin Dashbord here</h2>

@else

<h2> Super Admin Dashbord here</h2>

@endif

@endsection
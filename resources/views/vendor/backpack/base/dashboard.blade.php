@extends(backpack_view('blank'))

@php
	$userCount = App\Models\BackpackUser::count();
	$SupplierCount = App\Models\Supplier::count();	
	$CustomerCount = App\Models\Customer::count();
	$lastArticle = \Backpack\NewsCRUD\app\Models\Article::orderBy('date', 'DESC')->first();
	$lastArticleDaysAgo = \Carbon\Carbon::parse($lastArticle->date)->diffInDays(\Carbon\Carbon::today());
@endphp

	
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
  

   @php
    $widgets['before_content'][] = [
        'type'        => 'jumbotron',
        'wrapperClass'=> 'shadow-xs',
        'heading'     => trans('backpack::base.welcome'),
        'content'     => trans('backpack::base.use_sidebar'),
        'button_link' => backpack_url('logout'),
        'button_text' => trans('backpack::base.logout'),
    ];
   
@endphp

@section('content')
<!-- 
@if(backpack_user()->hasRole('supplier'))

<h2>Supplier Dashbord here</h2>

@elseif(backpack_user()->hasRole('customer'))

<h2> Customer Dashbord here</h2>

@elseif(backpack_user()->hasRole('admin'))

<h2> Admin Dashbord here</h2>

@elseif(backpack_user()->hasRole('superadmin'))

<h2> Super Admin Dashbord here</h2>

@endif	 -->

@endsection
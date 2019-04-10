<?php



namespace App\Repositories\traits;



use Illuminate\Http\Request;

use App\Repositories\traits\Micellenous;

trait Agrolytic {



	use Micellenous;

	public function processGet($route,Request $request){



		switch ($route) {

			case 'ify':

				return $this->getValue($request->red,$request->yellow,$request->greenbar);

				# code...

				break;

			case 'viewAgrolytic':

				# code...

				return $this->viewAgrolytic($request);

				break;

			case 'getSingleAgrolytic':

				# code...

				return $this->getSingleAgrolytic($request);

				break;

			case 'searchAcrolytic':

				# code...

				return $this->searchAcrolytic($request);

				break;

			case 'agrolyticReport':

				# code...

				return $this->agrolyticReport($request);

				break;

			case 'allUser':

				# code...

				return $this->allUser($request);

				break;

			case 'allCategory':

				# code...

				return $this->allCategory($request);

				break;

			case 'allCustomer':

				return $this->allCustomer($request);

				# code...

				break;

			case 'getStatusReport':

				# code...

				return $this->getStatusReport($request);

				break;

			case 'comments':

				# code...

				return $this->comments($request);

				break;

			

			default:

				# code...

				break;

		}

	}



	public function processPost(Request $request){

		try{

			// dd($request->All());

		 	switch ($request->type) {

		 		case 'addAgrolytic':

		 			# code...

		 			return $this->addAgrolytic('\App\Agrolytic',$request);

		 			break;

		 		case 'assignToOsp':

				# code...

					return $this->assignToOsp($request);

					break;

				case 'addAgrolyticReport':

					# code...

					return $this->addAgrolytic('\App\Report',$request);

					break;

				case 'addUser':

					# code...

					return $this->addUser($request);

					break;

				case 'viewSingleReport':

					# code...

					return $this->viewSingle('\App\Report',$request);

					break;

				case 'singleCategory':

					# code...

					return $this->viewSingle('\App\Category',$request);

					break;

				case 'addCategory':

					# code...

						return $this->addCategory($request);

					break;

				case 'addCustomer':

					# code...

					return $this->addCustomer($request);

					break;

				case 'addComment':

					return $this->addComment($request);

// 					# code...

					break;

				case 'delete':

				return $this->deleteRecord($request);

				# code...

				break;

		 		default:

		 			# code...

		 			break;

		 }

		}

		 catch(\Exception $ex){

	 

		 	return response()->json(['status'=>'error','message'=>$ex->getMessage()]);

		 }

	}



    private function viewSingle($model,Request $request){



    	$viewSingle=$model::where('id',$request->id)->with('user')->first();



    	return $viewSingle;

    	 

    }



    private function getValue($red,$yellow,$greenbar){



    	if($greenbar>($red+$yellow)){

    	 	return 2;

    	 }

    	 elseif($redbar > ($green+$yellow)){

    	 	return 1;

    	 }

    	 elseif($yellow>($green+$red)){

    	 	return 0;

    	 }

    }



    private function addCategory(Request $request){

    	if(in_array($request->user()->type,['prime_osp','prime_admin'])){

			throw new \Exception("Access Denied, Please Contact your Administrator");

					

		}

    	$saveCategory=\App\Category::updateOrCreate(['id'=>$request->id],$request->all());

    	return response()->json(['status'=>'success','message'=>'Operation Successful']);



    }



    private function allCategory(Request $request){



    	$categories=$category=\App\Category::get();

    	// dd($category);

    	return view('agrolytic.allCategory',compact('categories','category'));



    }



    private function getStatusReport(Request $request){

    	$data=[];

    	for($i=0; $i<=100; $i+=10){

    		$data[]=$this->countProgress("$i%");

    	}

    	return  $data;

    	   	    // var  data: [{x:'2016-12-25', y:20}, {x:'2016-12-26', y:10}]

    }



    private function countProgress($i){

    	$i=$i=="0%" ? ['Pending',"$i%"]: [$i] ;

    	return \App\Agrolytic::whereIn('prog_status',$i)->count('id');

    }



	private function addAgrolytic($model,Request $request){

		// dd($request->all());

		if($request->user()->type=='prime_osp' && $model=='\App\Agrolytic'){

			throw new \Exception("Access Denied");

					

		}

		$updateStatus=\App\Agrolytic::where('id',$request->agro_id)->update(['status'=>$request->status,'prog_status'=>$request->prog_status]);

 

		$this->notifyuser($request->op_rep,"agrolytic/agrolyticReport?id=$request->agro_id","$request->user()->name Just added a new report for {$updateStatus['agrolytics']} <br> Report : $request->report <br> Date: $request->day_week <br> Progress : $request->prog_status");



		$save=$model::updateOrCreate(['id'=>$request->id],$request->all());

		return response()->json(['status'=>'success','message'=>'Operation Successful']);

	}



	private function allUser(Request $request){

	if($request->user()->type=='prime_osp' ){

			return redirect('error');

					

		}

		$users=\App\User::where('id','>',0);

		if($request->has('q')){



		$users=$users->where(function($query) use ($request){

						$query->where('name','like',"%$request->q%")

								->orwhere("email",'like',"%$request->q%");



		});



		}

		if($request->user()->type=='prime_osp'){

			$users=$users->where('id',$request->user()->id);

		}

		$users=$users->paginate(10);

		$categories=\App\Category::get();



		return view('users.allUser',compact('users','categories'));

	}



	private function addUser(Request $request){

		if(in_array($request->user()->type,['prime_osp','prime_admin'])){

			throw new \Exception("You Do Not have the Priviledge to perform this operation");

			

		}

		$data=$request->all();

		if($request->has('password') && $request->password!=''){

			if($request->password !=$request->password_confirm){

				throw new \Exception("Password not match");

			

			}

			$data['password']=bcrypt($request->password);

		}

		else{

			unset($data['password']);

		}

		$data['type']=$request->type2;

		$adduser=\App\User::updateOrCreate(['id'=>$request->id],$data);

		return response()->json(['status'=>'success','message'=>'Operation Successful']);

	}



	private function viewAgrolytic(Request $request){

		$agrolytics=\App\Agrolytic::where('id','>',0);	

		if($request->has('start') && $request->start!=''){

			$agrolytics=$agrolytics->whereBetween('created_at',[$request->start,$request->end]);

		}

		if( $request->user()->type=='prime_osp'){

			$agrolytics=$agrolytics->where('op_rep',$request->user()->id);

		}

		if( $request->has('cat_id') && $request->cat_id!=''){

			$agrolytics=$agrolytics->where('cat_id',$request->cat_id);

		}

		if($request->has('prospect') && $request->prospect!=''){

			$agrolytics=$agrolytics->where('prospect',$request->prospect);

		}

	    if($request->has('life_cycle') && $request->life_cycle!=''){

			$agrolytics=$agrolytics->where('status',$request->life_cycle);

		}

		if($request->has('progress') && $request->progress!='') {

			$progress=$request->progress=="0%" ? ['Pending',"$request->progress%"]: [$request->progress] ;

			$agrolytics=$agrolytics->whereIn('prog_status',$progress);

		}

	    if($request->has('op_rep') && $request->op_rep!=''){

			$agrolytics=$agrolytics->where('op_rep',$request->op_rep);

		}

		$agrolytics=$agrolytics->with('category')->orderBy('id','desc')->paginate(10);

		 // dd($agrolytics);

		$categories=\App\Category::get();

		return view('agrolytic.viewAgrolytic',compact('agrolytics','categories'));

	}



	private function getSingleAgrolytic(Request $request){

		$agrolytic=\App\Agrolytic::where('id',$request->id)->with('user');

			 if($request->user()->type=='prime_osp' ){

			$agrolytic=$agrolytic->where('op_rep',$request->user()->id);

				}

			$agrolytic=$agrolytic->first();

		return $agrolytic;

	}



	private function agrolyticReport(Request $request){

		if($request->has('id')){

		$reports=\App\Report::where('agro_id',$request->id);

		}

		else{

		$reports=\App\Report::where('id','<>',0);	

		}

		if($request->has('start')){

			$reports=$reports->whereBetween('day_week',[$request->start,$request->end]);

		}





		if($request->user()->type=='prime_osp'){

			$reports=$reports->whereHas('agrolytic',function($query) use ($request){

									$query->where('op_rep',$request->user()->id);

										});

		}

		$reports=$reports->paginate(10);

		$id=$request->id;

		$categories=\App\Category::get();

		$agrolytic=$request->has('id') ? \App\Agrolytic::where('id',$id)->value('pag_objective') : 'All';

		return view('agrolytic.viewReport',compact('reports','id','agrolytic','categories'));

	}



	private function agrolyticsPerformanceReport($week){



			$process=['Perpetual','Purchase','Pipeline','Prospect','Present'];

			$allAgro=\App\Agrolytic::where('id','<>',0);

			$allAgro = $allAgro->where('user_id',\Auth::user()->id);

			if($week==1){

					$allAgro=$allAgro->whereBetween('updated_at',[date('Y-m-d',strtotime('-6 days')),date('Y-m-d',strtotime('+1 days'))]);

				}

				$allAgro=$allAgro->count('id');

			$status=[];

			foreach($process as $process){

				$pCOunt=\App\Agrolytic::where('status',$process);

				if($week==1){

					$pCOunt=$pCOunt->whereBetween('updated_at',[date('Y-m-d',strtotime('-6 days')),date('Y-m-d',strtotime('+1 days'))]);

				}

				$pCOunt=$pCOunt->count('id');

				if($allAgro==0){

				   $status[$process]=0;

				}

				else{

				$status[$process]=round(($pCOunt/$allAgro)*100,2);

				}

			}

			// $status;

 			return $status;

	}



 	private function miniReport($model){

 

		$start=date('Y-m-d',strtotime('-6 days'));

		$end=date('Y-m-d',strtotime('+1 days'));

 		$agre=$model::whereBetween('created_at',[$start,$end]);

 		if(\Auth::user()->type=='prime_osp'){

 			$column= $model=='\App\Agrolytic' ? 'op_rep' : 'user_id';

 			$agre=$agre->where($column,\Auth::user()->id);

 				}

 		$agre=$agre->count('id');

 		return $agre;

 	}





 	private function miniAgro(){

 		$allreport=\App\Report::where('id','>',0);

 		if(\Auth::user()->type=='prime_osp'){

 			$allreport=$allreport->where('user_id',\Auth::user()->id);

 		}

 		$allreport=$allreport->count('id');	  

 		// dd($this->miniReport('\App\Agrolytic'));

		return ['thisweek'=>$this->miniReport('\App\Agrolytic'),'thisweekreport'=>$this->miniReport('\App\Report'),'allreport'=>$allreport];



 	}

 	

	private function searchAcrolytic(Request $request){

		$name=\App\User::where('name','LIKE','%'.$request->q.'%')

						->select('id','name as text');

		if($request->user()->type=='prime_osp'){

			$name=$name->where('id',$request->user()->id);

					

		}

			$name=$name->whereIn('type',['prime_osp','prime_admin'])

						->get();

			return $name;

	}



	private function assignToOsp(Request $request){

		if($request->user()->type=='prime_osp'){

			return response()->json(['status'=>'error','message'=>'Access Denied']);

			

		} 

		$this->notifyuser($request->op_rep,"agrolytic/viewAgrolytic?op_rep=$request->op_rep",'An New Agrolytic report has been assigned to you');

		$assignToOsp=\App\Agrolytic::where('id',$request->id)->update(['op_rep'=>$request->op_rep]);

		return response()->json(['status'=>'success','message'=>'Operation Successful']);

	}



 	public function allCustomer(Request $request){

 		$customers=\App\Customer::where('id','<>',0);

 		if($request->has('q')){

		$customers=$customers->where(function($query) use ($request){

						$query->where('name','like',"%$request->q%")

								->orwhere("contact_email",'like',"%$request->q%")

								->orwhere('name',$request->q);



		});

		}

		$customers=$customers->paginate(10);

 		$categories=\App\Category::get();

 		return view('Customer.customers',compact('customers','categories'));

 	}



 	public function addCustomer(Request $request){

 		$addCustomer=\App\Customer::updateOrCreate(['id'=>$request->id],$request->all());

 		return response(['status'=>'success','message'=>'Operation Successful']);

 	}



 	public function addComment(Request $request){

 		$data=$request->all();

 		$data['type']=$request->type2;

 		$addcomment=\App\Comment::updateOrCreate(['id'=>$request->id],$data);

 

 		$this->notifyuser($addcomment->agrolytic->op_rep,"agrolytic/viewAgrolytic?id=$addcomment->agrolytic->id","$request->user()->name commented on Agrolytic Report <br> Company Objectives : $addcomment->agrolytic->comp_objective <br> Report : $addcomment->comment");



 		return response(['status'=>'success','message'=>'Operation Successful']);



 	}

 	public function comments(Request $request){

 		$comments=\App\Comment::where('type',$request->type)->paginate(1);

 		return view('partials.ajax.commentTrail',compact('comments'));

 	}



 	public function deleteRecord($request){

 			$model="\App\{$request->model}";

 			$model=str_replace(['}','{'], '', $model);

 			$delete=$model::where('id',$request->id);

 			if($request->model!='Report'){

 				$delete=$delete->whereDoesntHave($request->relation);

 			}

 			$delete=$delete->delete();

 			if(!$delete){

 				throw new \Exception("Unable to delete Record , because its already in use");	

 			}

 			return response(['status'=>'success','message'=>'Operation Successful']);

 				

 		}

 	

}




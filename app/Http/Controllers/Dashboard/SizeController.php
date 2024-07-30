<?php
namespace App\Http\Controllers\Dashboard;
use Illuminate\Http\Request;

use App\Services\SizeService;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use \Symfony\Component\HttpKernel\Exception\HttpException as Exception;
class SizeController extends Controller
{
    private $sizeService;

    public function __construct(SizeService $sizeService)
    {
        $this->sizeService = $sizeService;
    }
    public function index(Request $request)
    {
        // dd($request->all());
        try {
            $sizes = $this->sizeService->getAllSizes($request);
            if ($request->ajax()) {
                $total_size_view  = '';
                if ($sizes->count() > 0) {
                    foreach ($sizes as $size) {
                        $size_view = (string)view('dashboard.WebsiteManagement.Sizes.single-size-row', compact('size'));
                        $total_size_view = $total_size_view . $size_view;
                    }
                } else {
                    $size_view = (string)view('dashboard.WebsiteManagement.Sizes.single-size-row');
                    $total_size_view = $total_size_view . $size_view;
                }
                return response()->json([
                    'data' => $total_size_view,
                    'success' => true,
                ]);
            }
            return view('dashboard.WebsiteManagement.Sizes.all-sizes', compact('sizes'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:Sizes,name',
        ]);
        try {
            $sizes =  $this->sizeService->addSize($request);
            return response()->json([
                'success'=>true,
                'message'=>'Size added successfully',
                'size'=>$sizes,
            ]);
        }catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $exception) {
            return $exception->getMessage();

        }
    }
    public function edit($slug)
    {
        // dd($slug);
        try {
            $sizes = $this->sizeService->getSingleSize($slug);
            return response()->json([
                'success'=>true,
                'size'=>$sizes,
            ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$slug)
    {
        // dd($request->all(),$slug);
        $request->validate([
            'name' => 'required|unique:sizes,name',
        ]);
        try {
            $sizes = $this->sizeService->update($request,$slug);
            return response()->json([
                'success'=>true,
                'message'=>'Size updated successfully',
                'size'=>$sizes,
            ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        try {
            $sizes = $this->sizeService->deleteSize($slug);
            return response()->json([
                'success'=>true,
                'message'=>'Size deleted successfully',
                'size'=>$sizes,
            ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}

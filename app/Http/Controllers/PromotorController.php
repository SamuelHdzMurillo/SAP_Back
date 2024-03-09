<?php

namespace App\Http\Controllers;

use App\Http\Resources\PromotorResource;
use App\Models\Promotor;
use App\Models\Section;
use App\Models\Municipal;
use App\Models\Promoted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\password;

class PromotorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        // Consulta para obtener todos los promotores junto con las relaciones ansiosamente cargadas
        $query = Promotor::with('municipal.districts', 'section.promoteds');
        if ($req->has('name')) {
            $query->where('name', 'like', '%' . $req->input('name') . '%');
        }
        if ($req->has('phone_number')) {
            $query->where('phone_number', 'like', '%' . $req->input('phone_number') . '%');
        }
        if ($req->has('email')) {
            $query->where('email', 'like', '%' . $req->input('email') . '%');
        }
        if ($req->has('municipal_name')) {
            $query->whereHas('municipal', function ($q) use ($req) {
                $q->where('name', 'like', '%' . $req->input('municipal_name') . '%');
            });
        }
        if ($req->has("position")) {
            $query->where("position", $req->input("position"));
        }
        $promotores = $query->orderBy("created_at", "desc")->paginate(10);

        return PromotorResource::collection($promotores);
    }
    public function showPromoteds($promotorId)
    {
        try {
            $promotor = Promotor::with("promoteds")->findOrFail($promotorId);
            $promoteds = $promotor->getPromoteds();

            return response()->json(['promotor' => $promotor, 'promoteds' => $promoteds]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se encontró el promotor'], 404);
        }
    }
    public function uploadImage(Request $request, Promotor $promotor)
    {
        $validatedData = $request->validate([
            'profile_img_path' => 'image|nullable|max:1999',
        ]);
        if ($request->hasFile('profile_img_path')) {
            // Almacena la imagen en el disco 'public' en la carpeta 'images' y obtén su ruta
            $path = $request->file('profile_img_path')->store('images', 'public');

            // Agrega la ruta de la imagen a los datos validados
            $validatedData['profile_path'] = $path;
        }


        // Si se sube una nueva imagen, manejar la subida de archivos aquí

        $promotor->update($validatedData);


        return response()->json(['message' => 'Promotor actualizado con éxito.', 'data' => $promotor]);
    }

    public function showPromotedsCount($promotorId)
    {
        try {
            $promotor = Promotor::findOrFail($promotorId);
            $promotedsCount = $promotor->promoteds()->count(); // Usando el método count() para obtener la cantidad

            return response()->json([
                'promotor' => $promotor->name, // Ejemplo, solo devolvemos el nombre del promotor
                'promotedsCount' => $promotedsCount
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se encontró el promotor'], 404);
        }
    }

    public function showPromotedsCountByMunicipality($promotorId)
    {
        try {
            $promotor = Promotor::with('municipal.districts.sections.promoteds')->findOrFail($promotorId);

            $distribution = [];

            // Recorrer todos los municipios
            $municipalities = Municipal::with('districts.sections.promoteds')->get();

            foreach ($municipalities as $municipal) {
                // Recorrer cada distrito del municipio
                foreach ($municipal->districts as $district) {
                    // Recorrer cada sección del distrito
                    foreach ($district->sections as $section) {
                        // Filtrar los promovidos que están relacionados con el promotor específico
                        $relatedPromoteds = $section->promoteds->filter(function ($promoted) use ($promotorId) {
                            return $promoted->promotor_id == $promotorId; // Asumiendo que los promovidos tienen un campo 'promotor_id'
                        });

                        // Agregar al arreglo la distribución de promovidos por sección, solo si hay promovidos relacionados
                        if ($relatedPromoteds->isNotEmpty()) {
                            $distribution[] = [
                                'municipal_name' => $municipal->name, // Nombre del municipio
                                'district_name' => $district->number, // Número del distrito
                                'section_number' => $section->number, // Número de la sección
                                'promoteds_count' => $relatedPromoteds->count() // Cantidad de promovidos en la sección relacionados con el promotor
                            ];
                        }
                    }
                }
            }

            return response()->json([
                'promotor' => $promotor->name, // Nombre del promotor
                'total_promoteds_count' => collect($distribution)->sum('promoteds_count'), // Total de promovidos relacionados en todos los municipios
                'distribution' => $distribution // Distribución de promovidos por sección, distrito y municipio
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se encontró el promotor: ' . $e->getMessage()], 404);
        }
    }



    public function showPromotedsCountOnlyByMunicipality($promotorId)
    {
        try {
            $promotor = Promotor::with('municipal.districts.sections.promoteds')->findOrFail($promotorId);
            $municipal = $promotor->municipal;

            if ($municipal) {
                $promotedsCount = 0;
                foreach ($municipal->districts as $district) {
                    foreach ($district->sections as $section) {
                        $promotedsCount += $section->promoteds->count();
                    }
                }

                return response()->json([
                    'promotor' => $promotor->name, // Nombre del promotor
                    'municipal_name' => $municipal->name, // Nombre del municipio
                    'promotedsCount' => $promotedsCount // Cantidad de promovidos en el municipio corregido
                ]);
            } else {
                // En caso de que el promotor no esté asociado a un municipio
                return response()->json(['error' => 'El promotor no está asociado a un municipio'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se encontró el promotor: ' . $e->getMessage()], 404);
        }
    }

    public function showPromotedsCountByDistrict($promotorId, $districtId)
    {
        try {
            $promotor = Promotor::findOrFail($promotorId);
            $municipal = $promotor->municipal;

            if ($municipal) {
                $promotedsCount = 0;

                // Asegurarte de que solo estás contando los promovidos en secciones que pertenecen al distrito especificado
                $sections = Section::whereHas('district', function ($query) use ($districtId) {
                    $query->where('id', $districtId);
                })->pluck('id');

                if ($sections->isNotEmpty()) {
                    $promotedsCount = Promoted::whereIn('section_id', $sections)->count();
                }

                return response()->json([
                    'promotor' => $promotor->name, // Nombre del promotor
                    'municipal_name' => $municipal->name, // Nombre del municipio
                    'district_id' => $districtId, // ID del distrito solicitado
                    'promotedsCount' => $promotedsCount, // Cantidad de promovidos en el distrito especificado
                ]);
            } else {
                // En caso de que el promotor no esté asociado a un municipio
                return response()->json(['error' => 'El promotor no está asociado a un municipio'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se encontró el promotor: ' . $e->getMessage()], 404);
        }
    }









    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:promotors',
            'phone_number' => 'required',
            'position' => 'required',
            'password' => 'required|confirmed',
            'profile_path' => 'image|nullable|max:1999', // Asegúrate de que el archivo sea una imagen
            'ine_path' => 'image|nullable|max:1999', // Asegúrate de que el archivo sea una imagen
            'municipal_id' => 'required|exists:municipals,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validatedData = $validator->validated();
        $validatedData['password'] = bcrypt($validatedData['password']);

        // Verifica si se ha subido una imagen de perfil
        if ($request->hasFile('profile_path')) {
            $profilePath = $request->file('profile_path')->store('images/profiles', 'public');
            $validatedData['profile_path'] = $profilePath;
        }

        // Verifica si se ha subido una imagen de INE
        if ($request->hasFile('ine_path')) {
            $inePath = $request->file('ine_path')->store('images/ines', 'public');
            $validatedData['ine_path'] = $inePath;
        }

        $promotor = Promotor::create($validatedData);
        $promotorAdded = Promotor::with("municipal")->find($promotor->id);
        $promotorAdded["municipal_name"] = $promotorAdded["municipal"]["name"];
        return response()->json(['message' => 'Promotor creado con éxito.', 'data' => $promotorAdded], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Busca un promotor por su ID junto con todas las relaciones cargadas ansiosamente.
        $promotor = Promotor::with('municipal.districts',  'section.promoteds', "promoteds")->find($id);

        if (!$promotor) {
            return response()->json(['message' => 'Promotor no encontrado'], 404);
        }

        return response()->json($promotor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $promotor = Promotor::find($id);
        if (is_null($promotor)) {
            return response()->json(['message' => 'Promotor no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:promotors,email,' . $id,
            'phone_number' => 'required',
            'position' => 'required',
            'profile_path' => 'required',
            'ine_path' => 'required',
            'municipal_id' => 'required|exists:municipals,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $promotor->update($validator->validated());
        $promotorUpdated = Promotor::with("municipal")->find($id);
        $promotorUpdated["municipal_name"] = $promotorUpdated["municipal"]["name"];
        return response()->json($promotorUpdated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $promotor = Promotor::find($id);
        if (is_null($promotor)) {
            return response()->json(['message' => 'Promotor no encontrado'], 404);
        }

        $promotor->delete();
        return response()->json([
            "data" => $promotor
        ], 200);
    }
}

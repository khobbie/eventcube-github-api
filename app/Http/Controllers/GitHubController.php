<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GitHubController extends Controller
{
    private $github_base_url;

    public function __construct()
    {
        $this->github_base_url = env('GITHUB_BASE_URL');
    }
    public function getPhp(Request $request)
    {
        $page = $request->query('page', 1);
        $perPage = $request->query('per_page', 100);

        // return $perPage;

        try {
            //code...

            $response = Http::withHeaders([
                'Accept' => 'application/vnd.github.v3+json'
            ])->get($this->github_base_url . "?q=topic:php&page={$page}&per_page={$perPage}");

            $repositories = json_decode($response->getBody())->items;

            // Filter the repositories to only include the required fields
            $repositories = array_map(function ($repository) {
                return [
                    'id' => $repository->id,
                    'name' => $repository->name,
                    'full_name' => $repository->full_name,
                    'html_url' => $repository->html_url,
                    'language' => $repository->language,
                    'updated_at' => $repository->updated_at,
                    'pushed_at' => $repository->pushed_at,
                    'stargazers_count' => $repository->stargazers_count
                ];
            }, $repositories);

            return response()->json([
                'status' => 'success',
                'message' => 'Repositories found',
                'data' => [
                    'page' => $page,
                    'count_per_page' => count($repositories),
                    'repositories' => $repositories
                ]

            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
                'data' => NULL
            ], 500);
        }


    }

    public function getPopularPhp(Request $request)
    {
        $page = $request->query('page', 1);
        $perPage = $request->query('per_page', 100);

        try {
            //code...

            $response = Http::withHeaders([
                'Accept' => 'application/vnd.github.v3+json'
            ])->get($this->github_base_url . "?q=topic:php&page={$page}&per_page={$perPage}");

            $repositories = json_decode($response->getBody())->items;

            // Sort the repositories by stargazers_count in descending order
            usort($repositories, function ($a, $b) {
                return $b->stargazers_count - $a->stargazers_count;
            });

            // Filter the repositories to only include the required fields
            $repositories = array_map(function ($repository) {
                return [
                    'id' => $repository->id,
                    'name' => $repository->name,
                    'full_name' => $repository->full_name,
                    'html_url' => $repository->html_url,
                    'language' => $repository->language,
                    'updated_at' => $repository->updated_at,
                    'pushed_at' => $repository->pushed_at,
                    'stargazers_count' => $repository->stargazers_count
                ];
            }, $repositories);


            return response()->json([
                'status' => 'success',
                'message' => 'Repositories found',
                'data' => [
                    'page' => $page,
                    'count_per_page' => count($repositories),
                    'repositories' => $repositories
                ]

            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
                'data' => NULL
            ], 500);
        }




    }


    public function getActivityPhp(Request $request)
    {

        $page = $request->query('page', 1);
        $perPage = $request->query('per_page', 100);

        try {
            //code...

            $response = Http::withHeaders([
                'Accept' => 'application/vnd.github.v3+json'
            ])->get($this->github_base_url . "?q=topic:php&page={$page}&per_page={$perPage}");

            $repositories = json_decode($response->getBody())->items;

            // Sort the repositories by updated_at in descending order
            usort($repositories, function ($a, $b) {
                return strtotime($b->updated_at) - strtotime($a->updated_at);
            });

            // Filter the repositories to only include the required fields
            $repositories = array_map(function ($repository) {
                return [
                    'id' => $repository->id,
                    'name' => $repository->name,
                    'full_name' => $repository->full_name,
                    'html_url' => $repository->html_url,
                    'language' => $repository->language,
                    'updated_at' => $repository->updated_at,
                    'pushed_at' => $repository->pushed_at,
                    'stargazers_count' => $repository->stargazers_count
                ];
            }, $repositories);

            return response()->json([
                'status' => 'success',
                'message' => 'Repositories found',
                'data' => [
                    'page' => $page,
                    'count_per_page' => count($repositories),
                    'repositories' => $repositories
                ]

            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
                'data' => NULL
            ], 500);
        }




    }
}
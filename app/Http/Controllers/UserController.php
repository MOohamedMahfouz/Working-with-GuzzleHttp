<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:3000']);
    }
    private function get_color_by_rate($rate)
    {
        if ($rate >= 3000) {
            return 'red';
        } else if ($rate >= 2600) {
            return 'red';
        } else if ($rate >= 2400) {
            return 'red';
        } else if ($rate >= 2300) {
            return 'yellow';
        } else if ($rate >= 2100) {
            return 'yellow';
        } else if ($rate >= 1900) {
            return 'purple';
        } else if ($rate >= 1600) {
            return 'blue';
        } else if ($rate >= 1400) {
            return 'cyan';
        } else if ($rate >= 1200) {
            return 'green';
        } else if ($rate > 0) {
            return 'gray';
        } else if ($rate == 0) {
            return 'black';
        }
    }

    private $mapTagsCategories = [
        'string_algorithms' => ['strings', 'hashing', 'expression parsing'],
        'algorithmic_techniques' => ['binary search', 'divide and conquer', 'dp', 'meet-in-the-middle', 'ternary search', 'sortings'],
        'combinatorial_algorithms' => ['2-sat', 'combinatorics', 'graph matchings', 'probabilities'],
        'data_structures' => ['bitmasks', 'data structures', 'dsu', 'string suffix structures', 'trees'],
        'graph_algorithms' => ['dfs and similar', 'flows', 'graphs', 'shortest paths'],
        'mathematical_techniques' => ['chinese remainder theorem', 'fft', 'geometry', 'math', 'matrices', 'number theory'],
        'problem_solving_strategies' => ['brute force', 'constructive algorithms', 'greedy', 'implementation', 'two pointers'],
        'miscellaneous' => ['*special', 'games', 'interactive', 'schedules'],
    ];
    private function processApiRequestAndForwardData($response, $view_name, $tag_categories = null)
    {
        $data = json_decode($response->getBody()->getContents(), true);
        if ($data['status'] == 'OK') {
            $data = $data['result'];
            $collection = new Collection($data);
            $data = $collection->sortByDesc('rate_of_problem')->values()->all();
            $data = collect($data);
            $perPage = 50; // Number of items per page
            $page = request()->get('page', 1); // Get the current page number from the URL query string
            // Use the "slice" method to get a portion of the data based on the current page and number of items per page
            $slicedData = $data->slice(($page - 1) * $perPage, $perPage)->all();
            // Use the "LengthAwarePaginator" class to create a paginator instance
            $data = new LengthAwarePaginator($slicedData, $data->count(), $perPage, $page, [
                'path' => request()->url(),
                'query' => request()->query(),
            ]);
            $color = session()->get('color');
            $rating = session()->get('rating');
            $handle = session()->get('handle');
            return view("$view_name", [
                'data' => $data,
                'name' => $handle,
                'color' => $color,
                'rating' => $rating,
                'tag_categoires' => $this->mapTagsCategories["$tag_categories"] ?? [""]
            ]);
        } else {
            return redirect('/')->withErrors(['message' => 'Something Went Wrong. Try again, please.']);
        }
    }
    public function getRateBasedRecommendedProblems($type)
    {
        $handle = session()->get('handle');
        if ($tag ?? false) {
            $response = $this->client->request('GET', '/get_sim_problems?handle=' . $handle . '&type_of_problems=' . $type);
        } else {
            $response = $this->client->request('GET', '/get_sim_problems?handle=' . $handle . '&type_of_problems=' . $type);
        }
        return $this->processApiRequestAndForwardData($response, "index", $type);
    }
    public function getChoseTagsProblems(Request $request)
    {
        $currentUrl = $request->input('current_url');
        $urlParts = explode('/',$currentUrl);
        if ($urlParts[3] == 'rate-based-recommended-problmes') {
            $typeOfRecommendation = 'problems';
        } else {
            $typeOfRecommendation = 'submissions';
        }
        $problemsType = $urlParts[4];
        $handle = session()->get('handle');
        $tags = $request->input('tags_list');
        $tagList = implode(',', $tags);
        $response = $this->client->request('GET', '/get_sim_'.$typeOfRecommendation.'?handle=' . $handle . '&type_of_problems=' . $problemsType . '&tags_list=' . $tagList);
        return $this->processApiRequestAndForwardData($response, "index");
    }
    public function search(Request $request)
    {
        $response = $this->client->request('GET', '/search_problem_by_name?name=' . $request->input('search'));
        return $this->processApiRequestAndForwardData($response, "index");
    }
    public function getSolvedProblems()
    {
        $handle = session()->get('handle');
        $response = $this->client->request('GET', '/get_solved_problems?handle=' . $handle);
        return $this->processApiRequestAndForwardData($response, "index");
    }
    public function getLatestContests()
    {
        $response = $this->client->request('GET', '/get_contests');
        return $this->processApiRequestAndForwardData($response, "contests");
    }
    public function getUnsolvedProblems()
    {
        $handle = session()->get('handle');
        $response = $this->client->request('GET', '/get_un_solved_problems?handle=' . $handle);
        return $this->processApiRequestAndForwardData($response, "index");
    }
    public function getLatestSolvedBasedRecommendedProblems($type, $tag = null)
    {
        $handle = session()->get('handle');
        if ($tag ?? false) {
            $response = $this->client->request('GET', '/get_sim_submissions?handle=' . $handle . '&type_of_problems=' . $type . '&tags_list=' . $tag);
        } else {
            $response = $this->client->request('GET', '/get_sim_submissions?handle=' . $handle . '&type_of_problems=' . $type);
        }
        return $this->processApiRequestAndForwardData($response, "index", $type);
    }


    public function login(Request $request)
    {
        $client = $this->client;
        $response = $client->request('GET', '/CodeforcesHelper_api', [
            'query' => ['handle' => $request->input('handle')]
        ]);
        $data = json_decode($response->getBody()->getContents(), true);
        if ($data['status'] == 'OK') {
            $data = $data['result'][0];
            session()->put('color', $this->get_color_by_rate($data['rating'] ?? null));
            session()->put('rating', $data['rating'] ?? null);
            session()->put('handle', $request->input('handle'));
            return to_route('recommended-problems', ['string_algorithms']);
        } else {
            return redirect('/')->withErrors(['message' => 'Something Went Wrong. Try again, please.']);
        }
    }
}

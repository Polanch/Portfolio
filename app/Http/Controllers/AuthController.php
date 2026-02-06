<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }

        // Handle profile picture upload and convert to webp
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            try {
                $file = $request->file('profile_picture');
                $filename = time() . '_' . uniqid() . '.webp';
                $manager = new ImageManager(new Driver());
                $image = $manager->read($file)->toWebp(95);
                $webpData = $image->toString();
                $result = Storage::disk('public')->put('profile_pictures/' . $filename, $webpData);
                Log::info('WebP put result', ['result' => $result, 'filename' => $filename]);
                if (!$result) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to save profile picture.'
                    ], 500);
                }
                $profilePicturePath = 'profile_pictures/' . $filename;
            } catch (\Exception $e) {
                Log::error('Error processing image', ['error' => $e->getMessage()]);
                return response()->json([
                    'success' => false,
                    'message' => 'Error processing image: ' . $e->getMessage()
                ], 422);
            }
        }

        try {
            // Create user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'profile_picture' => $profilePicturePath,
            ]);

            // Log the user in
            Auth::login($user);

            return response()->json([
                'success' => true,
                'message' => 'Registration successful',
                'user' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating user: ' . $e->getMessage()
            ], 422);
        }
    }

    /**
     * Login user
     */
    public function login(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to login
        if (!Auth::attempt($validated)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password'
            ], 401);
        }

        $user = Auth::user();

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'user' => $user
        ], 200);
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // If it's a JSON request, return JSON
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Logout successful'
                ], 200);
            }

            // Otherwise redirect to home
            return redirect('/');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error logging out: ' . $e->getMessage()
                ], 422);
            }
            return redirect('/');
        }
    }

    /**
     * Get current logged in user
     */
    public function user(Request $request)
    {
        $user = $request->user();
        
        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated'
            ], 401);
        }
        
        return response()->json($user, 200);
    }
}


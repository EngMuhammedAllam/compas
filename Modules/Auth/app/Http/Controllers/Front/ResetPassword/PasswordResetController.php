<?php

namespace Modules\Auth\app\Http\Controllers\Api\ResetPassword;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Modules\Auth\app\Emails\ResetPasswordMail;
use Nette\Utils\Random;

class PasswordResetController extends Controller
{
    /**
     * Handle reset password request
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Check if user exists
        $user = DB::table('users')->where('email', $request->email)->first();
        
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'The provided email does not exist in our records.'
            ], 404);
        }

        // Create the token
        $token = (string) rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9). rand(0, 9) . rand(0, 9);

        /*******  548658  *******/    // Save the token in the database
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($token),
                'created_at' => now()
            ]
        );

        // Send the email
        try {
            Mail::to($request->email)->send(new ResetPasswordMail($token, $request->email));

            return response()->json([
                'status' => 'success',
                'message' => 'The link has been resent to your email.'
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send reset email: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send reset email. Please try again later.'
            ], 500);
        }
    }

    /**
     * Verify the token
     */ 
    public function verifyToken(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email'
        ]);

        $resetData = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$resetData) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to find reset request for this email'
            ], 404);
        }

        // Verify the token
        if (!Hash::check($request->token, $resetData->token)) {
            return response()->json([
                'status' => 'error',
                'message' => 'The reset token is invalid'
            ], 400);
        }

        // Verify expiration (60 minutes)
        if (now()->diffInMinutes($resetData->created_at) > 60) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return response()->json([
                'status' => 'error',
                'message' => 'The reset token has expired'
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'The reset token is valid'
        ]);
    }

    /**
     * Set the new password
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Verify the token first
        $resetData = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$resetData) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to find reset request for this email'
            ], 404);
        }

        if (!Hash::check($request->token, $resetData->token)) {
            return response()->json([
                'status' => 'error',
                'message' => 'The reset token is invalid'
            ], 400);
        }

        // Verify expiration (60 minutes)
        if (now()->diffInMinutes($resetData->created_at) > 60) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return response()->json([
                'status' => 'error',
                'message' => 'The reset token has expired'
            ], 400);
        }

        // Update the password
        DB::table('users')
            ->where('email', $request->email)
            ->update([
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(60),
            ]);

        // Delete the token after use
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Password updated successfully'
        ]);
    }
}
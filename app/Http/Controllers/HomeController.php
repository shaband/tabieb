<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenTok\ArchiveMode;
use OpenTok\MediaMode;
use OpenTok\OpenTok;
use OpenTok\OutputMode;
use OpenTok\Session;
use OpenTok\Role;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('test');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function test()
    {
//
//        $key = config('services.tokbox.key');
//        $opentok = new OpenTok(config('services.tokbox.key'), config('services.tokbox.secret'));
//
//
//        // Create a session that attempts to use peer-to-peer streaming:
//        $session = $opentok->createSession();
//
//// A session that uses the OpenTok Media Router, which is required for archiving:
//        $session = $opentok->createSession(array('mediaMode' => MediaMode::ROUTED));
//
//// A session with a location hint:
//        $session = $opentok->createSession(array('location' => '12.34.56.78'));
//
//// An automatically archived session:
//        $sessionOptions = array(
//            'archiveMode' => ArchiveMode::ALWAYS,
//            'mediaMode' => MediaMode::ROUTED
//        );
//        $session = $opentok->createSession($sessionOptions);
//
//
//// Store this sessionId in the database for later use
//        $sessionId = $session->getSessionId();
//
//// Generate a Token from just a sessionId (fetched from a database)
//   //     $token = $opentok->generateToken($sessionId);
//// Generate a Token by calling the method on the Session (returned from createSession)
//     //   $token = $session->generateToken();
//
//// Set some options in a token
//        $token = $session->generateToken(array(
//            'role' => Role::MODERATOR,
//            'expireTime' => time() + (7 * 24 * 60 * 60), // in one week
//            'data' => 'name=Johnny',
//            'initialLayoutClassList' => array('focus')
//        ));
//
//
//// Create a simple archive of a session
//       /* $archive = $opentok->startArchive($sessionId);
//
//
//        // Create an archive using custom options
//                $archiveOptions = array(
//                    'name' => 'Important Presentation',     // default: null
//                    'hasAudio' => true,                     // default: true
//                    'hasVideo' => true,                     // default: true
//                    'outputMode' => OutputMode::COMPOSED,   // default: OutputMode::COMPOSED
//                    'resolution' => '1280x720'              // default: '640x480'
//                );
//                $archive = $opentok->startArchive($sessionId, $archiveOptions);
//
//        // Store this archiveId in the database for later use
//                $archiveId = $archive->id;*/

        $sessionId = "1_MX40NjUxNDE2Mn5-MTU4Mzg3MDg5NDM5Nn5NM05ld29XZDdPcE1QbURSc2lLckNhaXp-fg";
        $token = 'T1==cGFydG5lcl9pZD00NjUxNDE2MiZzaWc9YjU3OTk2NWE1Y2I3MDAwMmZkNDZjMzM5NWUzY2EwNDJhYTVlYTQxYzpzZXNzaW9uX2lkPTFfTVg0ME5qVXhOREUyTW41LU1UVTRNemczTURnNU5ETTVObjVOTTA1bGQyOVhaRGRQY0UxUWJVUlNjMmxMY2tOaGFYcC1mZyZjcmVhdGVfdGltZT0xNTgzODcwOTA2Jm5vbmNlPTAuMDI3ODQyMTEzNDMxOTcwNjI4JnJvbGU9cHVibGlzaGVyJmV4cGlyZV90aW1lPTE1ODM4OTI1MDUmaW5pdGlhbF9sYXlvdXRfY2xhc3NfbGlzdD0=';
        return view('tokbox', compact('token', 'sessionId'));

    }

}

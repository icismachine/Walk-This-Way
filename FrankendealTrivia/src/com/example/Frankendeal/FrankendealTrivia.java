package com.example.Frankendeal;

import android.app.Activity;
import android.content.Context;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.util.Log;
import android.view.Window;
import android.webkit.WebView;

/*
public class FrankendealTrivia extends Activity implements GeolocationPermissions.Callback{
	WebView mWebView;
	
	
	
	/// Called when the activity is first created. 
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.main);
        
        mWebView = (WebView) findViewById(R.id.webview);
//        pbarDialog = new ProgressDialog(this);
//        pbarDialog.setCancelable(false);
//        pbarDialog.setProgressStyle(ProgressDialog.STYLE_SPINNER);
///       webview.setWebViewClient(new MyWebViewClient());
//       webview.getSettings().setJavaScriptEnabled(true);
//        webview.setWebChromeClient(new MyChromeWebViewClient());
//        webview.setVerticalScrollBarEnabled(false);
        mWebView.getSettings().setJavaScriptEnabled(true);
        mWebView.getSettings().setJavaScriptCanOpenWindowsAutomatically(true);
        mWebView.getSettings().setGeolocationEnabled(true);  //seems like if i set this, the webview should prompt when I call navigator.geolocation.getCurrentPosition
        GeolocationPermissions geoPerm = new GeolocationPermissions(); //added in API Level 5 but no methods exposed until API level 7
        GeoClient geo = new GeoClient();
        mWebView.setWebChromeClient(geo);        
        String origin = ""; //how to get origin in correct format?
        geo.onGeolocationPermissionsShowPrompt(origin, this);  //obviously not how this is meant to be used but expected usage not documented
        
        WebSettings webSettings = mWebView.getSettings();
        webSettings.setSavePassword(true);
        webSettings.setSaveFormData(true);
        webSettings.setSupportZoom(false);
        
        mWebView.loadUrl("http://frankendeal.com/test/test2.php");
    }
    
    public void invoke(String origin, boolean allow, boolean remember) {

    }

    final class GeoClient extends WebChromeClient {

	    @Override
	    public void onGeolocationPermissionsShowPrompt(String origin, Callback callback) {
	    // TODO Auto-generated method stub
	    super.onGeolocationPermissionsShowPrompt(origin, callback);
	    callback.invoke(origin, true, false);
	    }

    }
    
}
*/

//http://efreedom.com/Question/1-3767155/Getting-GPS-Location-Load-Another-URL
public class FrankendealTrivia extends Activity implements LocationListener{

    private WebView browserView;
     private static String PROVIDER="gps";
     private static final String LOG_TAG = "FrankenDeal";
     private LocationManager myLocationManager=null;
     private String url;
     private boolean LocFound = false;


    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
         super.onCreate(savedInstanceState);

         //Removes the title bar in the application
         requestWindowFeature(Window.FEATURE_NO_TITLE);
         setContentView(R.layout.main);

         //Creation of the Webview found in the XML Layout file
         browserView = (WebView)findViewById(R.id.webview); //webkit

         //Removes both vertical and horizontal scroll bars 
         browserView.setVerticalScrollBarEnabled(false);
         browserView.setHorizontalScrollBarEnabled(false);


         myLocationManager=(LocationManager)getSystemService(Context.LOCATION_SERVICE);
         //Enable Javascripts

         url = "http://frankendeal.com/logEvent.php";//"http://miniapps.co.uk/geometer/";

         browserView.getSettings().setJavaScriptEnabled(true);


         //The website which is wrapped to the webview

        browserView.loadUrl(url);


          }

    @Override
    public void onResume() {
    super.onResume();
    myLocationManager.requestLocationUpdates(PROVIDER, 0,
    0,
    this);
    }

    @Override
    public void onPause() {
    super.onPause();
    myLocationManager.removeUpdates(this);
    }

    public void locationFound(){

        myLocationManager.removeUpdates(this);

    }

        @Override
        public void onLocationChanged(Location location) {

            String lon = "lon="+String.valueOf(location.getLongitude());
            String lat = "lat="+String.valueOf(location.getLatitude());

            Log.i(LOG_TAG, url+"?"+lon+"&"+lat);
            browserView.loadUrl(url+"?"+lon+"&"+lat);
            locationFound();
        }

        @Override
        public void onProviderDisabled(String provider) {
            // TODO Auto-generated method stub

        }

        @Override
        public void onProviderEnabled(String provider) {
            // TODO Auto-generated method stub

        }

        @Override
        public void onStatusChanged(String provider, int status, Bundle extras) {
            // TODO Auto-generated method stub

        }

    }

/*all grouped together http://stackoverflow.com/questions/2352679/passing-gps-lonlat-from-android-gps-to-webpage-javascript
public class FrankendealTrivia extends Activity implements LocationListener {

    private static final String MAP_URL = "http://miniapps.co.uk/geometer/"; //"http://frankendeal.com/test/test2.php";
//	private static final String MAP_URL = "http://frankendeal.com/test/test2.php";
//	private static final String MAP_URL = "http://frankendeal.com/jstest.php";
	
	private WebView webView;
    private Location mostRecentLocation;
    private static final String LOG_TAG = "FrankenDeal";

    @Override
    // Called when the activity is first created. 
    public void onCreate(Bundle savedInstanceState) {
        try {
            super.onCreate(savedInstanceState);
            setContentView(R.layout.main);
            getLocation();

           // webView.getSettings().setJavaScriptEnabled(true);
          // webView.getSettings().setJavaScriptCanOpenWindowsAutomatically(true);
          //  webView.getSettings().setGeolocationEnabled(true);  //seems like if i set this, the webview should prompt when I call navigator.geolocation.getCurrentPosition
            setupWebView();
            Log.d(LOG_TAG, "help me!");
            this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
        } catch (Exception e) {
            e.printStackTrace();
        }

    }

    // Sets up the WebView object and loads the URL of the page 
    private void setupWebView() {

            final String centerURL = "javascript:centerAt("
                    + mostRecentLocation.getLatitude() + ","
                    + mostRecentLocation.getLongitude() + ")"; 
            Log.d(LOG_TAG, (String ) centerURL);
            webView = (WebView) findViewById(R.id.webview);
            webView.getSettings().setJavaScriptEnabled(true);

            webView.setWebViewClient(new WebViewClient() {
                @Override
                public void onPageFinished(WebView view, String url)
                {
                    String jsCode = "javascript:alert('" + getMostRecentLocation("lon") + "')";
                    webView.loadUrl(jsCode.toString());
                    Log.d(LOG_TAG, jsCode);
                }
            });


            webView.loadUrl(MAP_URL);
    }

    //
     // The Location Manager manages location providers. This code searches for
    // the best provider of data (GPS, WiFi/cell phone tower lookup, some other
    // mechanism) and finds the last known location.
     
    private void getLocation() {
        LocationManager locationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
        Criteria criteria = new Criteria();
        criteria.setAccuracy(Criteria.ACCURACY_FINE);
        String provider = locationManager.getBestProvider(criteria, true);

        // In order to make sure the device is getting location, request
        // updates. locationManager.requestLocationUpdates(provider, 1, 0,
        // this);
        //locationManager.requestLocationUpdates(provider, 1, 0, this);
        setMostRecentLocation(locationManager.getLastKnownLocation(provider));
    }

    public void locationFound(){

        myLocationManager.removeUpdates(this);

    }
    // Sets the mostRecentLocation object to the current location of the device 
    @Override
    public void onLocationChanged(Location location) {
        setMostRecentLocation(location);
    }

    //
     // The following methods are only necessary because WebMapActivity
     // implements LocationListener
     //
    @Override
    public void onProviderDisabled(String provider) {
    }

    @Override
    public void onProviderEnabled(String provider) {
    }

    @Override
    public void onStatusChanged(String provider, int status, Bundle extras) {
    }

    //
     / @param mostRecentLocation the mostRecentLocation to set
     //
    public void setMostRecentLocation(Location mostRecentLocation) {
        this.mostRecentLocation = mostRecentLocation;
    }

    //
     / @return the mostRecentLocation
     //
    public double getMostRecentLocation(String lonLat) {
        double gValue = 0.00;
        try
        {
        Location xx = this.mostRecentLocation;  //Used as a breakpoint
        if(lonLat == "lat") gValue = this.mostRecentLocation.getLatitude();
        if(lonLat == "lon") gValue = this.mostRecentLocation.getLongitude();        

        } catch (Exception e) {
            e.printStackTrace();
        }

        return gValue;  
    }

}
all grouped together */

/* jsilva 
private class MyChromeWebViewClient extends WebChromeClient {

	@Override
	public void onProgressChanged(WebView view, int progress) {
	    // Activities and WebViews measure progress with different scales.
	    // The progress meter will automatically disappear when we reach 100%
	    activity.setProgress(progress * 100);
	}

	@Override
	public boolean onJsAlert(WebView view, String url, String message, JsResult result) {
	    Log.d(LOG_TAG, message);
	    // This shows the dialog box.  This can be commented out for dev
	    AlertDialog.Builder alertBldr = new AlertDialog.Builder(activity);
	    alertBldr.setMessage(message);
	    alertBldr.setTitle("Alert");
	    alertBldr.show();
	    result.confirm();
	    return true;
	  }

	}

private class MyWebViewClient extends WebViewClient {

	@Override
	public boolean shouldOverrideUrlLoading(WebView view, String url) {
	    view.loadUrl(url);
	    return true;
	}

	@Override
	public void onReceivedError(WebView view, int errorCode,
	    String description, String failingUrl) {
	    }
	}
*/
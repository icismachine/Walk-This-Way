package com.cityquest;

import java.io.IOException;
import java.util.Date;

import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;

import android.app.Activity;
import android.content.Context;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.util.Log;

public class Start extends Activity {
	public static String TAG = Start.class.getCanonicalName();
	
	@Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.main);
        locationTest();
    }
    
    public void locationTest() {
    	LocationManager locationManager = (LocationManager) this.getSystemService(Context.LOCATION_SERVICE);    	

    	Log.i(TAG, "Last known location by GPS = " + 
    			humanReadableLocation((locationManager.getLastKnownLocation(LocationManager.GPS_PROVIDER))));
    	Log.i(TAG, "Last known location by NETWORK = " + 
    			humanReadableLocation((locationManager.getLastKnownLocation(LocationManager.NETWORK_PROVIDER))));
    	
    	locationManager.requestLocationUpdates(LocationManager.NETWORK_PROVIDER, 60000, 0, 
    			new LocationUpdatesCallback(LocationManager.NETWORK_PROVIDER));
    	locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, 60000, 0, 
    			new LocationUpdatesCallback(LocationManager.GPS_PROVIDER));
    	
    	httpTest();
    }
    
    public void httpTest() {
    	HttpClient client = new DefaultHttpClient();
    	HttpGet get = new HttpGet("http://www.google.com");
    	try {
			HttpResponse response = client.execute(get);
			Log.i(TAG, "GOOGLE = " + EntityUtils.toString(response.getEntity()));
		} catch (ClientProtocolException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}    	
    }
    
    public String humanReadableLocation(Location location){
		StringBuffer stringBuffer = new StringBuffer();
		stringBuffer.append("accuracy (m)= " + location.getAccuracy() + "\n");
		stringBuffer.append("altitude (m)= " + location.getAltitude() + "\n");
		stringBuffer.append("latitude = " + location.getLatitude() + "\n");
		stringBuffer.append("longitude= " + location.getLongitude() + "\n");
		stringBuffer.append("time = " + new Date(location.getTime()));
		return stringBuffer.toString();
    }
    
	class LocationUpdatesCallback implements LocationListener
	{
		String provider;
		
		public LocationUpdatesCallback(String provider)
		{
			this.provider = provider;
		}
		
		public void onLocationChanged(Location location) {
			Log.i(TAG, "Location update for provider " + provider);
			Log.i(TAG, "Location = " + humanReadableLocation(location));
		}

		public void onProviderDisabled(String provider) {
			Log.i(TAG, "Provider " + provider + " has been disabled");
		}

		public void onProviderEnabled(String provider) {
			Log.i(TAG, "Provider " + provider + " has been enabled");
		}

		public void onStatusChanged(String provider, int status, Bundle extras) {
			Log.i(TAG, "Provider " + provider  + " now has status " + status);
			Log.i(TAG, "Extras = " + extras.toString());
		}
	}
}
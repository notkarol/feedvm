package com.ufeedme.app.ufeedme;

import android.content.ContentResolver;
import android.content.ContentValues;
import android.content.Intent;
import android.net.Uri;
import android.provider.CalendarContract;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.webkit.WebView;
import android.webkit.WebViewClient;

import java.util.Calendar;

public class MainActivity extends ActionBarActivity {
    public void addEvent(String title, String location, Calendar begin, Calendar end) {
        Intent intent = new Intent(Intent.ACTION_INSERT)
                .setData(CalendarContract.Events.CONTENT_URI)
                .putExtra(CalendarContract.Events.TITLE, title)
                .putExtra(CalendarContract.Events.EVENT_LOCATION, location)
                .putExtra(CalendarContract.EXTRA_EVENT_BEGIN_TIME, begin)
                .putExtra(CalendarContract.EXTRA_EVENT_END_TIME, end);
        if (intent.resolveActivity(getPackageManager()) != null) {
            Log.d("blergh", "startActivity");
            startActivity(intent);

//                Intent i = new Intent(this, TestActivity.class);
//                startActivity(new Intent(i));

        }
    }
    @Override
    protected void onCreate(Bundle savedInstanceState) {
//        Calendar beginTime = Calendar.getInstance();
//        beginTime.set(2015, 3, 4, 7, 30);
//        Calendar endTime = Calendar.getInstance();
//        endTime.set(2015, 3, 4, 8, 30);
//        addEvent("Yoga", "Test", beginTime, endTime);

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        WebView myWebView = (WebView) findViewById(R.id.webView);
        myWebView.setWebViewClient(new MyWebViewClient());
        //url string variable
        String inputUrl = "https://www.uvm.edu/~jroen/ufeedme/web/";
        myWebView.loadUrl(inputUrl);
            }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    private class MyWebViewClient extends WebViewClient {
        @Override
        public boolean shouldOverrideUrlLoading(WebView view, String url) {


            url = "https://www.uvm.edu/~jroen/ufeedme/web/index.php?title=hi&start_date=3/12/2015&end_date=4/12/2015&start_time=3:00&end_time=4:00&food=hotdogs&location=burlington";
            Uri uri = Uri.parse(url);
//            Log.d("blergh", "url test : " + url);
//            Log.d("blergh", "uri test : " + uri.toString());
            Log.d("blergh", "title test : " + uri.getQueryParameter("title") + uri.getQueryParameter("start_date") +
                    uri.getQueryParameter("end_date") + uri.getQueryParameter("start_time") + uri.getQueryParameter("end_time") +
                    uri.getQueryParameter("food") + uri.getQueryParameter("location"));

            if (uri.getHost().equals("www.uvm.edu")) {
                if (!uri.getQueryParameter("title").isEmpty() &&
                !uri.getQueryParameter("start_date").isEmpty() &&
                !uri.getQueryParameter("end_date").isEmpty() &&
                !uri.getQueryParameter("start_time").isEmpty() &&
                !uri.getQueryParameter("end_time").isEmpty() &&
                        !uri.getQueryParameter("food").isEmpty() &&
                        !uri.getQueryParameter("location").isEmpty()
                        ){
                    //url has parameters, make an event for calendar
                    makeEvent(uri);
                }


                // This is my web site, so do not override; let my WebView load the page
                return false;
            }
            // Otherwise, the link is not for a page on my site, so launch another Activity that handles URLs
            Intent intent = new Intent(Intent.ACTION_VIEW, Uri.parse(url));
            startActivity(intent);
            return true;
        }

        private void startActivity(Intent intent) {

        }

        private void makeEvent(Uri uri){
            int[] start_date = parseDate(uri.getQueryParameter("start_date"));
            int[] end_date = parseDate(uri.getQueryParameter("end_date"));
            int[] start_time = parseTime(uri.getQueryParameter("start_time"));
            int[] end_time = parseTime(uri.getQueryParameter("end_time"));

            insertEvent(uri.getQueryParameter("title"), uri.getQueryParameter("food"),
                    start_date[0], start_date[1], start_date[2],
                    end_date[0], end_date[1], end_date[2],
                    start_time[0], start_time[1],
                    end_time[0], end_time[1],
                    uri.getQueryParameter("location")

            );
        }

        private int[] parseTime(String time){
            int[] time_vals = new int[2];
//            String[] date_split = time.split("%3A");
            String[] date_split = time.split(":");
            time_vals[0] = Integer.parseInt(date_split[0]);
            time_vals[1] = Integer.parseInt(date_split[1]);
            return time_vals;
        }

        private int[] parseDate(String date){
            int[] date_vals = new int[3];
//            String[] date_split = date.split("%2F");
            String[] date_split = date.split("/");
            date_vals[0] = Integer.parseInt(date_split[2]);
            date_vals[1] = Integer.parseInt(date_split[0]);
            date_vals[2] = Integer.parseInt(date_split[1]);

            return date_vals;
        }
        private void insertEvent(String title, String food,
                                 int start_year, int start_month, int start_day,
                                 int end_year, int end_month, int end_day,
                                 int start_hour, int start_minute,
                                 int end_hour, int end_minute,
                                 String location){


            Calendar beginTime = Calendar.getInstance();
            beginTime.set(start_year, start_month, start_day, start_hour, start_minute);
            Calendar endTime = Calendar.getInstance();
            endTime.set(end_year, end_month, end_day, end_hour, end_minute);
            addEvent(food, location, beginTime, endTime);

        }
    }
}


